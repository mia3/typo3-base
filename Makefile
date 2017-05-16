.PHONY: install build build-watch migrate production/deploy

# ----------------------------------------------------------------------#
# Local environment														#
# ----------------------------------------------------------------------#
assets_path = typo3conf/ext/template/Resources/Public/

all: install build

# ----------------------------------------------------------------------#
# Local environment														#
# ----------------------------------------------------------------------#

install:
	cd $(assets_path) && yarn install
	composer install

update-dependencies:
	cd $(assets_path) && yarn upgrade
	composer update

migrate:
	./vendor/bin/typo3cms database:updateschema '*.add, *.change'

build:
	cd $(assets_path) && ./node_modules/.bin/webpack -p

build-watch:
	cd $(assets_path) && ./node_modules/.bin/webpack --watch

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

define shell_production
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
	$(call shell_production, ./vendor/typo3cms cache:clear)
