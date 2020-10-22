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

define integration/shell
	ssh $(integration/user)@$(integration/host) -p$(integration/port) 'cd $(integration/path) &&$1'
endef

integration/deploy: install build emails/generate  ## Deploys to integration from your local machine. Updates database schema and clears caches
	git -C ./ ls-files --exclude-standard -oi --directory > /tmp/excludes;
	rsync -rzh -e 'ssh -p$(integration/port)' \
		'./' '$(integration/user)@$(integration/host):$(integration/path)' \
		--exclude=".git" \
		--exclude="public/typo3conf/AdditionalConfiguration.php" \
		--exclude-from="/tmp/excludes"
	rsync -rzh -e 'ssh -p$(integration/port)' \
		'./$(assets_path)/' '$(integration/user)@$(integration/host):$(integration/path)/$(assets_path)'
	$(call integration/shell, composer install)
	$(call integration/shell, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call integration/shell, php_cli ./vendor/bin/typo3cms cache:flush)

integration/clear-cache: ## Clears integration caches
	$(call integration/shell, php_cli ./vendor/bin/typo3cms cache:flush)

integration/connection-test: ## Tests connection to your project
	$(call integration/shell, cd $(integration/path) && ls -la)


# --------------------------------------------------------------------- #
# Staging environment                                                   #
# Branch: master                                                        #
# --------------------------------------------------------------------- #
staging/host =
staging/user =
staging/port = 22
staging/path =

define staging/shell
	ssh $(staging/user)@$(staging/host) -p$(staging/port) 'cd $(staging/path) &&$1'
endef

staging/deploy: install build emails/generate  ## Deploys to staging from your local machine. Updates database schema and clears caches
	git -C ./ ls-files --exclude-standard -oi --directory > /tmp/excludes;
	rsync -rzh -e 'ssh -p$(staging/port)' \
		'./' '$(staging/user)@$(staging/host):$(staging/path)' \
		--exclude=".git" \
		--exclude="public/typo3conf/AdditionalConfiguration.php" \
		--exclude-from="/tmp/excludes"
	rsync -rzh -e 'ssh -p$(staging/port)' \
		'./$(assets_path)/' '$(staging/user)@$(staging/host):$(staging/path)/$(assets_path)'
	$(call staging/shell, composer install)
	$(call staging/shell, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call staging/shell, php_cli ./vendor/bin/typo3cms cache:flush)

staging/clear-cache: ## Clears staging caches
	$(call staging/shell, php_cli ./vendor/bin/typo3cms cache:flush)

staging/connection-test: ## Tests connection to your project
	$(call staging/shell, cd $(staging/path) && ls -la)


# --------------------------------------------------------------------- #
# Production environment                                                #
# Branch: master (manual)                                               #
# --------------------------------------------------------------------- #
production/host =
production/user =
production/port = 22
production/path =

define production/shell
	ssh $(production/user)@$(production/host) -p$(production/port) 'cd $(production/path) &&$1'
endef

production/deploy: install build emails/generate  ## Deploys to production from your local machine. Updates database schema and clears caches
	git -C ./ ls-files --exclude-standard -oi --directory > /tmp/excludes;
	rsync -rzh -e 'ssh -p$(production/port)' \
		'./' '$(production/user)@$(production/host):$(production/path)' \
		--exclude=".git" \
		--exclude="public/typo3conf/AdditionalConfiguration.php" \
		--exclude-from="/tmp/excludes"
	rsync -rzh -e 'ssh -p$(production/port)' \
		'./$(assets_path)/' '$(production/user)@$(production/host):$(production/path)/$(assets_path)'
	$(call production/shell, composer install)
	$(call production/shell, php_cli ./vendor/bin/typo3cms database:updateschema)
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/clear-cache: ## Clears production caches
	$(call production/shell, php_cli ./vendor/bin/typo3cms cache:flush)

production/connection-test: ## Tests connection to your project
	$(call production/shell, cd $(production/path) && ls -la)


# --------------------------------------------------------------------- #
# Backup                                                                #
# --------------------------------------------------------------------- #
pull-backup: ## Download latest files and import database dump from operations.mia3.com
	@echo "\033[1;31mNo backup available:\033[0m add this project to \033[1;32moperations.mia3.com\033[0m and replace this command with the backup code."
