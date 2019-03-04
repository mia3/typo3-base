.PHONY: help install test run build deploy/staging
.DEFAULT_GOAL := help
assets_path = public/typo3conf/ext/template/Resources/Public

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
	| sed "s/{{host}}/$$DB_HOST/g" | sed "s/{{dbName}}/$$DB_NAME/g" | sed "s/{{user}}/$$DB_USER/g" | sed "s/{{password}}/$$DB_PW/g" > public/typo3conf/AdditionalConfiguration.php;

setup: install setup/database-connection migrate build/development clear-cache ## Project installation.
	./vendor/bin/typo3cms extension:setupactive
	./vendor/bin/typo3cms backend:createadmin

# ----------------------------------------------------------------------#
# Backup environment													#
# ----------------------------------------------------------------------#



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
		--exclude="public/typo3conf/AdditionalConfiguration.php" \
		--exclude-from="/tmp/excludes" \
		-e 'ssh -p$(production/port)' \
		'./' \
		'$(production/user)@$(production/host):$(production/path)'
	rsync -rz \
		--progress \
		-e 'ssh -p$(production/port)' \
		'./$(assets_path)/Build/' \
		'$(production/user)@$(production/host):$(production/path)/$(assets_path)/Build/'
	$(call production/shell, composer install)
	$(call production/shell, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/clear-cache: ## Fluses production caches
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/connection-test: ## Tests connection to your project
	$(call production/shell, cd $(production/path) && ls -la)
