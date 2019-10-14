.PHONY: help install test run build deploy/staging
.DEFAULT_GOAL := help
assets_path = public/typo3conf/ext/template/Resources/Public

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


# ----------------------------------------------------------------------#
# Local environment                                                     #
# ----------------------------------------------------------------------#

setup: install-dependencies setup/database-connection migrate build clear-cache ## Setup the new project
	./vendor/bin/typo3cms extension:setupactive
	./vendor/bin/typo3cms backend:createadmin

build/watch: ## Build assets with sourcemaps and watch for changes
	./node_modules/.bin/encore dev --watch


install-dependencies: ## Install composer and yarn dependencies
	composer install
	yarn install

update-dependencies: ## Update composer and yarn dependencies
	composer update
	yarn upgrade

build: ## Build assets with sourcemaps
	./node_modules/.bin/encore dev

build/production: ## Build minified assets
	./node_modules/.bin/encore production

migrate: ## Apply database migration
	./vendor/bin/typo3cms database:updateschema '*.add, *.change'

clear-cache: ## Clear TYPO3 cache
	./vendor/bin/typo3cms cache:flush

setup/database-connection: ## Create an AdditionalConfiguration.php
	@read -p "Enter DB host: " DB_HOST; \
	read -p "Enter DB name: " DB_NAME; \
	read -p "Enter DB username: " DB_USER; \
	read -p "Enter DB password: " DB_PW; \
 	cat public/typo3conf/AdditionalConfiguration.php.example \
	| sed "s/{{host}}/$$DB_HOST/g" | sed "s/{{dbName}}/$$DB_NAME/g" | sed "s/{{user}}/$$DB_USER/g" | sed "s/{{password}}/$$DB_PW/g" > public/typo3conf/AdditionalConfiguration.php;


# ----------------------------------------------------------------------#
# Backup environment                                                    #
# ----------------------------------------------------------------------#

pull-backup: ## Download latest files and import database dump from operations.mia3.com
	@echo "\033[1;31mNo backup available:\033[0m add this project to \033[1;32moperations.mia3.com\033[0m and replace this command with the backup code."


# ----------------------------------------------------------------------#
# Production environment                                                #
# ----------------------------------------------------------------------#

production/host = typo3.template.mia3.com
production/user = p284571
production/port = 22
production/path = /home/www/p284571/html

define production/shell
	ssh $(production/user)@$(production/host) -p$(production/port) 'cd $(production/path) &&$1'
endef

production/deploy: build/production  ## Deploys to production from your local machine. Updates database schema and clears caches
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

production/clear-cache: ## Clears production caches
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/connection-test: ## Tests connection to your project
	$(call production/shell, cd $(production/path) && ls -la)
