# TYPO3 Base

This repository contains a base for a TYPO3 Project and works as a skeleton for future sites.
When starting an new Project please feel free to adjust this ReadMe to your specification.  
If you notice any Issue when using this repo as project base, please submit the problem as Issue

## Table of Cotents
- Installation
- MakeFile
- Structure of this Repository
- Frontend
    - Javascript Guidelines
    - CSS Guidelines
- Gitlab Deployment.


## Installation

1. To start with your project, clone this repository running:

    ```
    ssh://git@gitlab.mia3.com:30001/template/TYPO3-Base.git
    ```
2. Then you can trigger the installation by running: 

    ```
    make setup/project
    ```

3. After the command is done, you should have a folder structure like this:
    ```
    node_modules/               // ...
    typo3_src/                  // ...
    vendor/                     // installed composer packages
    web/ 
        fileadmin/              // ...
        typo3/                  // -> typo3_src/typo3
        typo3conf/              // ...
        typo3temp/              // exist after running accessing your project in your browser 
        index.php               // -> typo3/index.php
        uploads/                // ...
        .htaccess
    .gitignore
    .editorconfig
    composer.json               // dependencies with version that will be installed
    composer.lock               // Contains a file with the current installed pacakges and versions
    MakeFile                    // ...       
    package.json                // Node.js dependencies
    postcss.config.js           // config file for PostCSS
    webpack.config.js           // Encore config
    yarn.lock                   // installed Node-packages with their versions.
    ```

4.  Log in via installTool (`local.your-project.de/typo3/install`) and check your Image scaling Note: From Default GraphicsMagick should be installed on your **local** machine, if not install it via Brew.
   
    Log into the backend with your admin user and create a new page. Enable the page and switch to ‚Behavior‘ and tick "Use as Root Page" checkbox.
    
    Go to WEB/Template settings and click "Click here to create an extension template."
    Change the View from "Constant Editor" to "Info/Modify" and click on "Edit the whole template record"-button.
        
    Switch to "Options" and tick all three checkboxes(Constants, Setup, Rootlevel). Click on
    "Includes"-Tab and include all items in the following order:         
    - Fluid Content Elements
    - Fluid Content Elements CSS
    - Form
    - Template
        
    Change to WEB/Page and edit the root Page. Go to the ‚Appearance‘-Tab and choose "Fluidpages" as Backend Layout for the root Page and subpages and save it.

5. Now that you verified that your typo3 instance works, you can setup a gitlab project:
    - remove the `.git` folder to loose any reference to this repository 
    - initialize a new git repo with `git init`  and set the origin to your gitlab repository
    - make your initial commit.

6. In the MakeFile configure the backup and production credentials

7. Make it awesome! 

## MakeFile

Thanks to make we can trigger certain commands under one command without writing a bash script.
If you have dependencies that your project is based on e.g. setting up a Search instance or a specific procedure, you can sum it up in one command.

Current Commands that exists:
```
build/development              Build assets with sourcemaps.
build/production               Build assets for production, minified version and without sorucemaps.
build/watch                    Build assets after changes.
clear-cache                    Clear local cache.
install                        Install composer and yarn dependencies
migrate                        Apply any relevant database migration.
production/clear-cache         Fluses production caches
production/connection-test     Tests connection to your project
production/deploy              Deploys to production from your Local Machine. Updates Database schema and flushes caches
pull-backup                    Pulls a Backup from this project
setup/database-connection      Creates a AdditionalConfiguration.php
setup/project                  Project installation.
update-dependencies            Update composer and yarn dependencies

```
 
## Structure of the template Extension

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
        Assets/                     // CSS and Javascript Files
        Language/                   // Trainslations
        Layouts/                    // HTML that's the same on various page templates
        Partials/                   // Reusable Parts
        Templates/
            Content/                // Content Elements based on fluidcontent
            Page/                   // Page Templates based on fluidpages
    Public/                         // Styles, Scripts and etc.
```

## Frontend

For compiling CSS and transpiling JavaScript we use webpack which is based on Node JS

## Guidelines

* [Zen Of CSS](http://gitlab.mia3.com:30000/snippets/4)
* [Zen Of Naming](http://gitlab.mia3.com:30000/snippets/5)


### Javascript

Including jQuery in your project will bring a huge overhead and it will cost you performance.
Instead of using this huge library we use vue-components to encapsulate HTML and JS together. 


Example:
```html
    <good-component>
        <h1> Hello World </h1>
    </good-component>
    
    <bad-component>
        Hello World 
    </bad-component>
```

## Setup Gitlab Ci

- create gitlab.ci.yml and adjust it 
- create ssh key 
- Add to gitlab
- push it into your repository 
