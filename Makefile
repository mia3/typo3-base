.PHONY: help install test run build deploy/staging
.DEFAULT_GOAL := help
assets_path = typo3conf/ext/template/Resources/Public
web_root = ./web/

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# ----------------------------------------------------------------------#
# Local environment														#
# ----------------------------------------------------------------------#

build/development:  ## Build assets with sourcemaps.
	./node_modules/.bin/encore dev

build/production: ## Build assets for production, minified version and without sorucemaps.
	./node_modules/.bin/encore production

build/watch: ## Build assets after changes.
	./node_modules/.bin/encore dev --watch

install: ## Install composer and yarn dependencies
	yarn install
	composer install

update-dependencies: ## Update composer and yarn dependencies
	yarn upgrade
	composer update

migrate:  ## Apply any relevant database migration.
	./vendor/bin/typo3cms database:updateschema '*.add, *.change'

clear-cache: ## Clear local cache.
	./vendor/bin/typo3cms cache:flush

setup/database-connection: ## Creates a AdditionalConfiguration.php
	@read -p "Enter Host: " DB_HOST; \
	read -p "Enter Database: " DB_NAME; \
	read -p "Enter User: " DB_USER; \
	read -p "Enter Password: " DB_PW; \
 	cat public/typo3conf/AdditionalConfiguration.php.example \
	| sed "s/{{host}}/$$DB_HOST/g" | sed "s/{{dbName}}/$$DB_NAME/g" | sed "s/{{user}}/$$DB_USER/g" | sed "s/{{password}}/$$DB_PW/g" > web/typo3conf/AdditionalConfiguration.php;

setup/project: install build/development setup/database-connection ## Project installation.

# ----------------------------------------------------------------------#
# Backup environment													#
# ----------------------------------------------------------------------#
backup_user = mia3
backup_host = rack.mia3.com
backup_port = 3322
backup_path = /var/www/public/typo3.template.mia3.com/backup/

pull-backup: ## Pulls a Backup from this project
	rsync -rz --progress -e 'ssh -p$(backup_port)' '$(backup_user)@$(backup_host):$(backup_path)' './'
	./vendor/bin/typo3cms database:import < usr_p284571_1.sql
	./vendor/bin/typo3cms cache:flush

# ----------------------------------------------------------------------#
# Production environment												#
# ----------------------------------------------------------------------#
production/host = typo3.template.mia3.com
production/user = p284571
production/port = 22
production/path = /home/www/p284571/html


define production/shell
	ssh $(production/user)@$(production/host) -p$(production/port) 'cd $(production/path) &&$1'
endef



production/deploy: build/production  ## Deploys to production from your Local Machine. Updates Database schema and flushes caches
	git -C ./ ls-files --exclude-standard -oi --directory > /tmp/excludes;
	rsync --recursive --compress \
		--progress \
		--exclude=".git" \
		--exclude="web/typo3conf/AdditionalConfiguration.php" \
		--exclude-from="/tmp/excludes" \
		-e 'ssh -p$(production/port)' \
		'./' \
		'$(production/user)@$(production/host):$(production/path)'
	rsync -rz \
		--progress \
		-e 'ssh -p$(production/port)' \
		'./web/$(assets_path)/Build/' \
		'$(production/user)@$(production/host):$(production/path)/web/$(assets_path)/Build/'
	$(call production/shell, composer install)
	$(call production/shell, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/clear-cache: ## Fluses production caches
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/connection-test: ## Tests connection to your project
	$(call production/shell, cd $(production/path) && ls -la)
