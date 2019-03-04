// webpack.config.js
let Encore = require('@symfony/webpack-encore');

const assetPath = './public/typo3conf/ext/template/Resources/Public/';

// directory where all compiled assets will be stored
Encore.setOutputPath(assetPath + 'Build/')
// what's the public path to this directory (relative to your project's document root dir)
.setPublicPath('/typo3conf/ext/template/Resources/Public/Build/')
.enableSingleRuntimeChunk()
// will output as web/build/app.js
.addEntry('Main', [
    assetPath + 'Scripts/Main.js',
    assetPath + 'Styles/Main.css'
])
.enableVueLoader()
.enablePostCssLoader()
.enableSourceMaps(!Encore.isProduction());

// export the final configuration
module.exports = Encore.getWebpackConfig();