#!/bin/bash

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No color

for ARGUMENT in "$@"; do
  KEY=$(echo "$ARGUMENT" | cut -f1 -d=)
  VALUE=$(echo "$ARGUMENT" | cut -f2 -d=)

  case "$KEY" in
  --srv) _SRV=${VALUE} ;;
  --path) _PATH=${VALUE} ;;
  --port) _PORT=${VALUE} ;;
  --assets) _ASSETS=${VALUE} ;;
  --assets2) _ASSETS2=${VALUE} ;;
  --php) _PHP=${VALUE} ;;
  --env) _ENV=${VALUE} ;;
  *) ;;
  esac
done

# Function to execute a command in the remote shell
function remote_shell() {
  ssh "$_SRV" -p "$_PORT" "cd $_PATH && $1"
}

if [ -z "$_PATH" ]; then
  echo -e "[${RED}DEPLOY${NC}] --path is empty"
  exit 1
fi

# Default SSH port
if [ -z "$_PORT" ]; then
  _PORT=22
fi

# Default PHP binary
if [ -z "$_PHP" ]; then
  _PHP="php"
fi

# Check for a file called ENABLE_DEPLOYMENT. Prevents uploads in the wrong directory.
echo -e "[${GREEN}DEPLOY${NC}] Checking for file ENABLE_DEPLOYMENT in remote directory..."
if ssh "$_SRV" stat "$_PATH/ENABLE_DEPLOYMENT" \> /dev/null 2\>\&1; then
  echo -e "[${GREEN}DEPLOY${NC}] ...file exists. ${GREEN}OK${NC}"
else
  echo -e "[${RED}DEPLOY${NC}] ...file does not exist. ${RED}STOP${NC}"
  exit 1
fi

# Upload tracked files from the public directory
git -C ./ ls-files --exclude-standard -oi --directory >/tmp/excludes
echo -e "[${GREEN}DEPLOY${NC}] Uploading tracked files to ${YELLOW}$_SRV${NC}@${YELLOW}$_HOST${NC}:${YELLOW}$_PATH${NC} on port ${YELLOW}$_PORT${NC}"
rsync -az -e "ssh -p $_PORT" ./ "$_SRV:$_PATH" --exclude=".git" --exclude="sh" --exclude-from="/tmp/excludes"

if [ -n "$_ASSETS" ]; then
  # Sync *untracked* generated assets
  echo -e "[${GREEN}DEPLOY${NC}] Uploading generated assets: $_ASSETS/"
  rsync -azv -e "ssh -p $_PORT" "$_ASSETS/" "$_SRV:$_PATH/$_ASSETS"
fi

if [ -n "$_ASSETS2" ]; then
  # Sync *untracked* generated assets
  echo -e "[${GREEN}DEPLOY${NC}] Uploading generated assets: $_ASSETS2/"
  rsync -azv -e "ssh -p $_PORT" "$_ASSETS2/" "$_SRV:$_PATH/$_ASSETS2"
fi

# Composer
if ssh "$_SRV" stat "composer" \> /dev/null 2\>\&1; then
  echo -e "[${GREEN}DEPLOY${NC}] Using composer to update vendor directory"
  remote_shell 'composer install --no-dev --optimize-autoloader --ignore-platform-reqs'
fi

# TYPO3
if ssh "$_SRV" stat "$_PATH/vendor/bin/typo3cms" \> /dev/null 2\>\&1; then
  echo -e "[${GREEN}DEPLOY${NC}] Updating TYPO3 database schema"
  remote_shell "$_PHP ./vendor/bin/typo3cms database:updateschema"

  echo -e "[${GREEN}DEPLOY${NC}] Flushing TYPO3 cache"
  remote_shell "$_PHP ./vendor/bin/typo3cms cache:flush"
fi

# Symfony
if ssh "$_SRV" stat "$_PATH/bin/console" \> /dev/null 2\>\&1; then
  echo -e "[${GREEN}DEPLOY${NC}] Updating Symfony database schema"
  remote_shell "$_PHP ./bin/console doctrine:migrations:migrate --no-interaction)"

  echo -e "[${GREEN}DEPLOY${NC}] Installing Symfony assets"
  remote_shell "$_PHP ./bin/console assets:install)"

  if [ "$_ENV" == "production" ]; then
    echo -e "[${GREEN}DEPLOY${NC}] Symfony - clearing cache (production)"
    remote_shell "$_PHP ./bin/console cache:clear --env=prod)"
  else
    echo -e "[${GREEN}DEPLOY${NC}] Symfony - clearing cache"
    remote_shell "$_PHP ./bin/console cache:clear)"
  fi
fi

echo -e "[${GREEN}DEPLOY${NC}] Done"
