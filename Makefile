.PHONY: help install test run build
.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

define env/shell
	ssh $($1/user)@$($1/host) -p $($1/port) 'cd $($1/path) && $2'
endef

define env/download
	rsync -rzPh -e 'ssh -p $($1/port)' --files-from="rsync_download.txt" \
		'$($1/user)@$($1/host):$($1/path)/' '.'
endef

define env/upload
	rsync -rzPh -e 'ssh -p $($1/port)' --files-from="rsync_upload.txt" \
		'./' '$($1/user)@$($1/host):$($1/path)'
endef

define env/upload/delete
	rsync -rz --delete -e 'ssh -p $($1/port)' --files-from="rsync_upload_delete.txt" \
		'./' '$($1/user)@$($1/host):$($1/path)'
endef


# ---------------------------------------------------------------------------- #
# Backup
# ---------------------------------------------------------------------------- #
pull-backup: ## Download latest backup (including database)
	@echo "\033[1;31mNo backup available:\033[0m add this project to \033[1;32moperations.mia3.com\033[0m and replace this command with the backup code."


# ---------------------------------------------------------------------------- #
# Local
# ---------------------------------------------------------------------------- #
setup: install setup/config migrate build cache ## Setup a new project
	vendor/bin/typo3cms extension:setupactive
	vendor/bin/typo3cms backend:createadmin admin

setup/config: ## Generates config file (AdditionalConfiguration.php)
	@read -p "Enter DB host: " DB_HOST; \
	read -p "Enter DB name: " DB_NAME; \
	read -p "Enter DB username: " DB_USER; \
	read -p "Enter DB password: " DB_PW; \
 	cat public/typo3conf/AdditionalConfiguration.php.example \
	| sed "s/{{host}}/$$DB_HOST/g" | sed "s/{{dbName}}/$$DB_NAME/g" | sed "s/{{user}}/$$DB_USER/g" | sed "s/{{password}}/$$DB_PW/g" > public/typo3conf/AdditionalConfiguration.php;

build: ## Build assets with sourcemaps
	@yarn
	@yarn encore dev

build/watch: ## Build assets with sourcemaps and watch for changes
	@yarn encore dev --watch

build/production: ## Build minified assets
	@yarn
	@yarn encore production

install: ## Install dependencies (Composer and Yarn)
	@composer i
	@yarn

upgrade: ## Upgrade dependencies (Composer and Yarn)
	@composer u
	@yarn upgrade
	@make migrate
	@make cache

migrate: ## Update database schema (TYPO3 Database Compare)
	@vendor/bin/typo3cms database:updateschema "*"

cache: ## Clear cache
	@vendor/bin/typo3cms cache:flush

emails: ## Generate email templates
	@yarn mjml ./packages/template/Resources/Private/Email/*.mjml --output ./packages/template/Resources/Private/Templates/Email;


# ---------------------------------------------------------------------------- #
# Integration
# Branch: dev
# ---------------------------------------------------------------------------- #
integration/host =
integration/user =
integration/port = 22
integration/path =


# ---------------------------------------------------------------------------- #
# Staging
# Branch: main
# ---------------------------------------------------------------------------- #
staging/host =
staging/user =
staging/port = 22
staging/path =


# ---------------------------------------------------------------------------- #
# Production
# Branch: main (manual)
# ---------------------------------------------------------------------------- #
production/host = typo3.mia3.com
production/user = p284571
production/port = 22
production/path = /html/typo3.mia3.com

production/deploy: build
	$(call env/upload/delete,production)
	$(call env/shell,production,composer --no-interaction --optimize-autoloader --no-progress --no-dev --profile install)
	$(call env/shell,production,vendor/bin/typo3cms database:updateschema | vendor/bin/typo3cms cache:flush)

production/connection-test: ## Test deployment connection
	$(call env/shell,production, ls -la)

production/ssh: ## Establish SSH connection
	ssh $(production/user)@$(production/host) -p $(production/port)

production/media/push: ## Upload media files (see rsync_upload.txt)
	$(call env/upload,production)

production/media/pull: ## Download media files (see rsync_download.txt)
	$(call env/download,production)

production/database/pull: ## Overwrite local database with remote
	$(call env/shell,production,vendor/bin/typo3cms database:export) > db.sql
	mysql --defaults-file=my.cnf < db.sql
	rm db.sql

production/database/push: ## Overwrite remote database with local
	vendor/bin/typo3cms database:export > db.sql
	$(call env/shell,production,vendor/bin/typo3cms database:import) < db.sql
	rm db.sql
