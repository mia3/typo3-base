# TYPO3 Base

This repository contains a base for a TYPO3 Project and works as a skeleton for future sites.

When starting an new Project please feel free to adjust this ReadMe to important 

##Table of Cotents
- Installation
- MakeFile
- Structure of this Repository
- Javascript Guidelines
- CSS Guidelines


### Installation

1. To start with your project, clone this repository running:

    ```
    git clone ssh://git@gitlab.a3plus.de:30001/template/TYPO3-Base.git
    ```
2. Then you can trigger the installation by running: 

    ```
    make setup/project
    ```

3. After the command is done, you should have a folder structure like this:
    ```
    fileadmin/                  // ...
    typo3_src/                  // ...
    uploads/                    // ...
    vendor/                     // ...
    web/ 
        typo3/                  // -> typo3_src/typo3
        typo3conf/              // ...
        typo3temp/              // exist after running accessing your project in your browser 
        index.php               // -> typo3/index.phphp
        .htaccess
    MakeFile
    composer.json
    composer.lock
    .gitignore
    .editorconfig        
    ```
4. Go to ` web/typo3conf/AdditionalConfiguration.php` and adjust your settings to your local machine 
### MakeFile

Thanks to make we can trigger certain commands under one command without writing a bash script.
If you have dependencies that your project is based on e.g. setting up a Search instance or a specific procedure, you can sum it up in one command.

Current Commands that exists:
```
build-watch                    // keep building assets whenever a file changes and output sourcemaps
build                          // build assets without sourcemaps, etc.
cache-clear                    // clear the local cache
install                        // install composer and yarn dependencies
migrate                        // apply any relevant database migration
production/cache-clear         // clears Caches in production
production/connection-test     // Tests connection to your project
production/deploy              // Deploys to production
production/push-data           // syncs dump, fileadmin and uploads folder to production
pull-backup                    // Pulls a Backup from this project
setup/config                   // creates a Additional Configuration File
update-dependencies            // update composer and yarn dependencies

```
 
### Structure of the template Extension

```
Classes/
    ViewHelpers/                    // contains Fluid ViewHelpers.
        ContentWrapViewHelper.php   // The Extensions comes already with a ViewHelper that sets
Configuration/
    TsConfig/
        Page.ts
        Rte.ts
        User.ts
    TypoScript/
        Setup/
            Bootstrap.ts
            Content.ts
            Extensions.ts
            Pages.ts
            SEO.ts
            Settings.ts
        setup.txt
        constants.txt
Resources/
    Private/
        Language/                   // Trainslations
        Layouts/                    // HTML that's the same on various page templates
        Partials/                   // Reusable Parts
        Templates/
            Content/                // Content Elements based on fluidcontent
            Page/                   // Page Templates based on fluidpages
    Public/                         // Styles, Scripts and etc.
```