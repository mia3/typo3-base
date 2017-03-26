# TYPO3 Base

## Installation

1. clone repository

```
git clone ssh://git@gitlab.a3plus.de:30001/template/TYPO3-Base.git
```

2. dependencies installieren

```
cd TYPO3-Base
composer install
```

3. import database.sql

4. copy ```typo3conf/AdditionalConfiguration.php.example``` to ```typo3conf/AdditionalConfiguration.php``` and set configuration for local machine

### Structure of the template Extension

```
Resources/Public              // Contains all css, js, images, fonts, etc
  - Media/*                   // Media files like images, etc
  - Components/*              // External Libraries and Components
  - Styles/Components/*.less  // custom component styles
  - Styles/Base.less          // General Styling mainly focused towards desktop
  - Styles/Main.less          // ties all the other styles together
  - Scripts/Main.js           // Place to put custom JS code

Configuration/TypoScript/Setup  // Contains all PHP code to modify WP behavior
  - Bootstrap.ts                // Page configuration and CSS/JS Header includes
  - Language.ts                 // Configuration for Language
  - Extensions.ts               // Place to put TypoScipt for different Extensions

Resources/Private               // Templates
  - Templates/Page              // Page Templates based on fluidpages
  - Templates/Content           // Content Elements based on fluidcontent
  - Layouts                     // HTML that's the same on various page templates
  - Partials                    // Reusable Parts
  - Extensions/[ExtName]/...    // Place to put altered extension templates
```

### Usefull commands

**Update Database Schema**

```
./vendor/bin/typo3cms database:updateschema
```