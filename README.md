# TYPO3 Base

## Installation

1. clone repository

```
git clone ssh://git@gitlab.a3plus.de:30001/a3plus/Elektro_Beckhoff.git
```

2. dependencies installieren

```
cd TYPO3-Base
composer install
```

3. download current userdata backup from ```http://backups.mia3.com/elektro-beckhoff.mia3.com/```, extract and import the database

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