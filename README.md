# MIA3 . TYPO3 CMS Base Distribution

Get going quickly with TYPO3 CMS.


## Prerequisites

* PHP 7.2
* [Composer](https://getcomposer.org/download/)
* [ImageMagick](https://imagemagick.org/script/download.php)
* [GraphicsMagick](http://www.graphicsmagick.org/download.html)


## Quickstart

* `composer create-project mia3/typo3-base project-name --stability=dev`
* `cd project-name`
* `git init`
* `git add .`
* `git commit -a -m "Initial commit"`
* `make setup`


## Setup / Installation

1. To start with your project, clone this repository running:
    ```bash
    git clone ssh://git@gitlab.mia3.com:2222/mia3/typo3.git
    ```
2. Then run the following command, to change into your project folder:
    ```bash
    cd acme.com
    ```
3. After using this command, you should be able to run the following command to install TYPO3 and all necessary dependencies:
    ```bash
    make install
    ```
4. Set up a local server environment(e.g: MAMP) and create a new database for this project. To avoid errors with the "Application Context", use `local.acme.com` as domain for this environment.
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

## Directory Structure

```
assets/
├── template/
│   ├── Scripts/
│       ├── Components/
│           ├── Button/
│           ├── Form/
│           ├── MobileMenu/
│       ├── Utility/
│   ├── Styles/
│       ├── Base/
│       ├── ContentElements/
│       ├── Extensions/
│       ├── PageLayout/
│       ├── Utility/
config/
packages/
├── template/
│   ├── Classes/
│       ├── Controller/
│       ├── Domain/
│       ├── Service/
│       ├── TcaUserFunctions/
│       ├── Utility/
│       ├── ViewHelpers/
│   ├── Configuraton/
│       ├── FlexForms/
│       ├── RTE/
│       ├── TCA/
│           ├── Overrides/
│               ├── Mask/
│                   ├── Columns/
│                   ├── Pages/
│                   ├── Types/
│               ├── tt_content/
│       ├── TsConfig/
│       ├── TypoScript/
│   ├── Initialisation/
│   ├── Resources/
│       ├── Private/
│           ├── ExtensionOverrides/
│           ├── Language/
│           ├── Mask/
│           ├── Partials/
│           ├── Templates/
│       ├── Pulblic/
public/
webpack/
```
### Directories explained

- `assets/` . All assets for the template extension
  - `Scripts/` . All Vue-Components and JavaScript-Files
  - `Styles/` . All Styles
    - `Base/` . Simple and general stylings (Typography, Forms, Buttons ...)
    - `ContentElements/` . Stylings for all Content-Elements in the template extension
    - `Extensions/` . Override stylings in 3rd-Party extensions
    - `PageLayout/` . Styling for page layout componets like header, footer etc.
    - `Utility/` . Styling which can be useful in many situations and which is highly reusable
- `config/` . TYPO3 Site-Configuration
- `packages/` . Locale composer repository to load custom extensions for this page
  - `template/` . The custom template extension for this web site
    - `Classes/`
      - `Controller/` . Controller for this extension
      - `Domain/` . Domain-Models for this extension
      - `Service/` . Services for this extension
      - `TcaUserFunctions/` . Classes which should support and extend TCA functionallity
      - `Utility/` . Utility-Classes, only to make YOUR life easier
      - `ViewHelpers/` . Custom-ViewHelpers for every situation
  - `Configuration/`
    - `TCA/Overrides/` . TCA Overrides
      - `Mask/` . TCA Overrides for Mask-Elements
        - `Columns/` . Override Mask-Columns
        - `Pages/` . Override TCA by Page-Type / Backend-Layout
        - `Types/` . Override Mask-Fields by Type
      - `tt_content/` . Override TYPO3-Native fields
  - `Resources/`
    - `Private/`
      - `ExtensionOverrides/` . Override template files for 3rd-Party extensions
      - `Language/` . Language files
      - `Mask/` . Mask template files (Backend + Frontend)
      - `Partials/` . General Partials
      - `Templates/` . Genral Tempaltes
- `webpack/` . Splitted webpack configuration files, can be used to combine multiple build-procecces into one

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


## CSS and JavaScript

CSS and JavaScript files are located in the `assets` directory.


## Forms

Each form has its own plugin. To add another form:

0. Create domain model -> `Classes/Domain/Model/MyFormRequest.php`
0. Register a new plugin -> `Configuration/TCA/Overrides/tt_content.php`
0. Configure the new plugin -> `ext_localconf.php`
0. Create flexform -> `Configuration/FlexForm/MyForm.xml`


# To Do

* Update README.md
  * Where to add CSS
  * Where to add JS
* page.meta.description empty default?
* How to use CSS variables (postcss-config.js)
* Site URL config:
  * `Development/Local`
  * -> `Development/Integration`
  * -> `Production/Staging`
  * -> `Production`
