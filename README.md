# MIA3 . TYPO3 CMS Base Distribution

Get going quickly with TYPO3 CMS.

## Prerequisites

* PHP 7.2
* [Composer](https://getcomposer.org/download/)

## Quickstart

* `composer create-project mia3/typo3-base project-name --stability=dev`
* `cd project-name`
* `git init`
* `git add .`
* `git commit -a -m "Initial commit"`
* `make setup`


# TYPO3 . local.typo3-base

## Table of Cotents
* Prerequisites
* Setup / Installation
* Structure of the template (public/typo3conf/ext/template/)

## Prerequisites

* PHP 7.2
* [Composer](https://getcomposer.org/download/)

## Setup / Installation

1. To start with your project, clone this repository running:
    ```bash
    git clone ssh://git@gitlab.mia3.com:30001/mia3/mecondo.de.git
    ```
2. Then run the following command, to change into your project folder:
    ```bash
    cd mecondo.de
    ```
3. After using this command, you should be able to run the following command to install TYPO3 and all necessary dependencies:  
    ```bash
    make install
    ```
4. Set up a local server environment(e.g: MAMP) and create a new database for this project. To avoid errors with the "Application Context", use `local.mecondo.de` as domain for this environment.
5. Now you can run the following command, to set up your local database connection.
    ```bash
    make setup/env
    ```
6. Enter your local database information and then run:
    ```bash
    make pull-backup
    ```
    This will download the images und database-dump from the last Backup. 
    If everything has been set up correctly, the database dump will be automatically imported into the created database.
7. Finally, you should execute the following command to bundle all CSS and Javascript files.
    ```bash
    make build/watch
    ```
8. Make it awesome!


## Structure of the template (public/typo3conf/ext/template/)

```
Resources/Public                // Contains all css, js, images, fonts, etc
Media/*                         // Media files like images, etc
Components/*                    // External Libraries and Components
Styles/Components/*.less        // custom component styles
Styles/Base.less                // General Styling mainly focused towards desktop
Styles/Main.less                // ties all the other styles together
Scripts/Main.js                 // Place to put custom JS code
Configuration/TypoScript/Setup  // Contains all PHP code to modify WP behavior
Bootstrap.ts                    // Page configuration and CSS/JS Header includes
Language.ts                     // Configuration for Language
Extensions.ts                   // Place to put TypoScipt for different Extensions
Resources/Private               // Templates
Templates/Page                  // Page Templates based on fluidpages
Templates/Content               // Content Elements based on fluidcontent
Layouts                         // HTML that's the same on various page templates
Partials                        // Reusable Parts
Extensions/[ExtName]/...        // Place to put altered extension templates
```

## Makefile

With [Make](https://www.gnu.org/software/make/) we can combine multiple commands without writing a bash script.

Current commands that exists:

### Local environment

```bash
make setup                      # Setup the new project
make build/watch                # Build assets with sourcemaps and watch for changes

make install-dependencies       # Install composer and yarn dependencies
make update-dependencies        # Update composer and yarn dependencies
make setup/database-connection  # Create an AdditionalConfiguration.php
make migrate                    # Apply database migration
make build                      # Build assets with sourcemaps
make build/production           # Build minified assets
make clear-cache                # Clear TYPO3 cache
make pull-backup                # Download latest files and import database dump from operations.mia3.com
```

### Staging environment

```bash
make staging/deploy          Deploys to staging from your local machine. Updates database schema and flushes caches.
make staging/clear-cache     Flush staging caches.
make staging/push-backup:    Deploys local database to staging from your machine.
```

### Production environment

```bash
make production/deploy # Try not to use this command. Always deploy from GitLab to the production environment.
```

# To Do

* Update README.md
  * Where to add CSS
  * Where to add JS 
* page.meta.description empty default?
* How to use CSS variables (postcss-config.js)
* Composer install process via Makefile
* Site URL config (Local, Staging?, Dev, Integration?, Production)
