// webpack.config.js
let Encore = require('@symfony/webpack-encore');

const outPutPath = './web/typo3conf/ext/template/Resources/'
const assetPath = outPutPath+'Private/Assets/';

// directory where all compiled assets will be stored
Encore.setOutputPath(outPutPath+'Public/Build/')
    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/Build')
    // will output as web/build/app.js
    .addEntry('Main.compiled', [
        assetPath+ 'Scripts/Main.js',
        assetPath+ 'Styles/Main.css'
    ])
    .enableVueLoader()
    .enablePostCssLoader()
    .enableSourceMaps(!Encore.isProduction());

// export the final configuration
module.exports = Encore.getWebpackConfig();