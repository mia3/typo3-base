.PHONY: help install test run build
.DEFAULT_GOAL := help

define env/shell
	ssh $($1/user)@$($1/host) -p $($1/port) 'cd $($1/path) && $2'
endef

define env/upload
	rsync -rzPh -e 'ssh -p $($1/port)' --files-from="rsync_deploy.txt" \
		'./' '$($1/user)@$($1/host):$($1/path)'
endef

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# --------------------------------------------------------------------- #
# Local environment                                                     #
# --------------------------------------------------------------------- #

setup: install setup/database-connection migrate build clear-cache ## Setup the new project
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
	yarn
	./node_modules/.bin/encore dev

build/production: ## Build minified assets
	yarn
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

emails/generate:
	./node_modules/.bin/mjml ./packages/template/Resources/Private/Email/*.mjml --output ./packages/template/Resources/Private/Templates/Email;


# --------------------------------------------------------------------- #
# Integration environment                                               #
# Branch: dev                                                           #
# --------------------------------------------------------------------- #
integration/host =
integration/user =
integration/port = 22
integration/path =

integration/deploy:
	yarn
	make build

	# Upload
	$(call env/upload,integration)

	# Composer
	$(call env/shell,integration, COMPOSER_DISCARD_CHANGES=true composer install --no-dev --optimize-autoloader --ignore-platform-reqs)

	# TYPO3
	$(call env/shell,integration, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call env/shell,integration, php_cli ./vendor/bin/typo3cms cache:flush)

integration/clear-cache: ## Clears integration cache
	$(call env/shell,integration, php_cli ./vendor/bin/typo3cms cache:flush)

integration/connection-test: ## Tests connection to your project
	$(call env/shell,integration, ls -la)


# --------------------------------------------------------------------- #
# Staging environment                                                   #
# Branch: master                                                        #
# --------------------------------------------------------------------- #
staging/host =
staging/user =
staging/port = 22
staging/path =

staging/deploy:
	yarn
	make build

	# Upload
	$(call env/upload,staging)

	# Composer
	$(call env/shell,staging, COMPOSER_DISCARD_CHANGES=true composer install --no-dev --optimize-autoloader --ignore-platform-reqs)

	# TYPO3
	$(call env/shell,staging, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call env/shell,staging, php_cli ./vendor/bin/typo3cms cache:flush)

staging/clear-cache: ## Clears staging cache
	$(call env/shell,staging, php_cli ./vendor/bin/typo3cms cache:flush)

staging/connection-test: ## Tests connection to your project
	$(call env/shell,staging, ls -la)


# --------------------------------------------------------------------- #
# Production environment                                                #
# Branch: master (manual)                                               #
# --------------------------------------------------------------------- #
production/host =
production/user =
production/port = 22
production/path =

production/deploy:
	yarn
	make build

	# Upload
	$(call env/upload,production)

	# Composer
	$(call env/shell,production, COMPOSER_DISCARD_CHANGES=true composer install --no-dev --optimize-autoloader --ignore-platform-reqs)

	# TYPO3
	$(call env/shell,production, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call env/shell,production, php_cli ./vendor/bin/typo3cms cache:flush)

production/clear-cache: ## Clears production cache
	$(call env/shell,production, php_cli ./vendor/bin/typo3cms cache:flush)

production/connection-test: ## Tests connection to your project
	$(call env/shell,production, ls -la)


# --------------------------------------------------------------------- #
# Backup                                                                #
# --------------------------------------------------------------------- #
pull-backup: ## Download latest files and import database dump from operations.mia3.com
	@echo "\033[1;31mNo backup available:\033[0m add this project to \033[1;32moperations.mia3.com\033[0m and replace this command with the backup code."
