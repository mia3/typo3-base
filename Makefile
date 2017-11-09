.PHONY: help install test run build deploy/staging
.DEFAULT_GOAL := help
assets_path = web/typo3conf/ext/template/Resources/Public/
web_root = ./web/

help:
	@grep -E '^[a-zA-Z\/_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# ----------------------------------------------------------------------#
# Local environment														#
# ----------------------------------------------------------------------#

build: ## build assets without sourcemaps, etc.
	cd $(assets_path) && ./node_modules/.bin/webpack -p

build-watch: ## keep building assets whenever a file changes and output sourcemaps
	cd $(assets_path) && ./node_modules/.bin/webpack --watch

install: ## install composer and yarn dependencies
	cd $(assets_path) && yarn install
	composer install

update-dependencies: ## update composer and yarn dependencies
	cd $(assets_path) && yarn upgrade
	composer update

migrate:  ## apply any relevant database migration
	./vendor/bin/typo3cms database:updateschema '*.add, *.change'

cache-clear: ## clear the local cache
	./vendor/bin/typo3cms cache:flush

setup/config: ## creates a Additional Configuration File
	$(shell cat web/typo3conf/AdditionalConfiguration.php.example | sed 's/\/\// /g' >> web/typo3conf/AdditionalConfiguration.php )

setup/project: install build

# ----------------------------------------------------------------------#
# Backup environment													#
# ----------------------------------------------------------------------#
backup_user = mia3
backup_host = rack.mia3.com
backup_port = 3322
backup_path = /var/www/public/typo3.template.mia3.com/backup/

pull-backup:
	rsync -rz --progress -e 'ssh -p$(backup_port)' '$(backup_user)@$(backup_host):$(backup_path)' './'
	beard db:restore usr_p284571_1.sql

# ----------------------------------------------------------------------#
# Production environment												#
# ----------------------------------------------------------------------#
production/host = typo3.template.mia3.com
production/user = p284571
production/port = 22
production/path = /home/www/p284571/html/

define production/shell
    ssh $(production/user)@$(production/host) -p$(production/port) 'cd $(production/path) &&$1'
endef

production/deploy:
	rsync -rz \
		--progress \
		--exclude=".git" \
		--exclude="fileadmin" \
		--exclude="uploads" \
		--exclude="c7atreusdev.sql" \
		--exclude='typo3temp' \
		--exclude="typo3conf/AdditionalConfiguration.php" \
		-e 'ssh -p$(production/port)' \
		'./' \
		'$(production/user)@$(production/host):$(production/path)'
	$(call shell_production, composer install)
	$(call shell_production, chmod -R 775 .)
	$(call shell_production, ./vendor/typo3cms database:updateschema '*.add, *.change' 2>&1)
	$(call shell_production, ./vendor/typo3cms cache:clear)

production/push-data:
	rsync -rz \
		--progress \
		--include="fileadmin/***" \
		--include="uploads/***" \
		--include="c7atreusdev.sql" \
		--exclude="*" \
		-e 'ssh -p$(production/port)' \
		'./' \
		'$(production/user)@$(production/host):$(production/path)'

production/cache-clear:
	$(call production/shell, php56 ./vendor/bin/typo3cms cache:flush)

production/connection-test:
	$(call production/shell, cd $(production/path) && ls -la)