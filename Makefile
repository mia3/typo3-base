.PHONY: help install test run build deploy/staging
.DEFAULT_GOAL := help

# Upload *untracked* generated assets on deployment
assets_path = packages/template/Resources/Public/Build

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


# --------------------------------------------------------------------- #
# Local environment                                                     #
# --------------------------------------------------------------------- #
setup: install-dependencies setup/database-connection migrate build clear-cache ## Setup the new project
	./vendor/bin/typo3cms extension:setupactive
	./vendor/bin/typo3cms backend:createadmin admin

build/watch: ## Build assets with sourcemaps and watch for changes
	./node_modules/.bin/encore dev --watch


install: ## Install composer and yarn dependencies
	composer install
	yarn install

update: ## Update composer and yarn dependencies
	composer update
	yarn upgrade

build: ## Build assets with sourcemaps
	./node_modules/.bin/encore dev

build/production: ## Build minified assets
	./node_modules/.bin/encore production

migrate: ## Apply database migration
	./vendor/bin/typo3cms database:updateschema

clear-cache: ## Clear TYPO3 cache
	./vendor/bin/typo3cms cache:flush

setup/database-connection: ## Create an AdditionalConfiguration.php
	@read -p "Enter DB host: " DB_HOST; \
	read -p "Enter DB name: " DB_NAME; \
	read -p "Enter DB username: " DB_USER; \
	read -p "Enter DB password: " DB_PW; \
 	cat public/typo3conf/AdditionalConfiguration.php.example \
	| sed "s/{{host}}/$$DB_HOST/g" | sed "s/{{dbName}}/$$DB_NAME/g" | sed "s/{{user}}/$$DB_USER/g" | sed "s/{{password}}/$$DB_PW/g" > public/typo3conf/AdditionalConfiguration.php;


# --------------------------------------------------------------------- #
# Integration environment                                               #
# Branch: dev                                                           #
# --------------------------------------------------------------------- #
integration/srv = user@host
integration/path =
integration/port = 22
integration/php = php # Sometimes php_cli or php7.3-cli

integration/deploy:
	@bash sh/deploy.sh \
		--srv=$(integration/srv) \
		--path=$(integration/path) \
		--port=$(integration/port) \
		--php=$(integration/php) \
		--assets=$(assets_path)


# --------------------------------------------------------------------- #
# Staging environment                                                   #
# Branch: master                                                        #
# --------------------------------------------------------------------- #
staging/srv =
staging/path =
staging/port =
staging/php =

staging/deploy:
	@bash sh/deploy.sh \
		--srv=$(staging/srv) \
		--path=$(staging/path) \
		--port=$(staging/port) \
 		--php=$(staging/php) \
		--assets=$(assets_path)


# --------------------------------------------------------------------- #
# Production environment                                                #
# Branch: master (manual)                                               #
# --------------------------------------------------------------------- #
production/srv =
production/path =
production/port =
production/php =

production/deploy:
	@bash sh/deploy.sh \
		--srv=$(production/srv) \
		--path=$(production/path) \
		--port=$(production/port) \
		--php=$(production/php) \
		--assets=$(assets_path) \
		--env="production"


# --------------------------------------------------------------------- #
# Backup                                                                #
# --------------------------------------------------------------------- #
pull-backup: ## Download latest files and import database dump from operations.mia3.com
	@echo "\033[1;31mNo backup available:\033[0m add this project to \033[1;32moperations.mia3.com\033[0m and replace this command with the backup code."
