// webpack.config.js
let Encore = require('@symfony/webpack-encore');

const assetPath = './assets/template/';
const buildPath = './packages/template/Resources/Public/Build/';

// directory where all compiled assets will be stored
Encore
  .setOutputPath(buildPath)
  // what's the public path to this directory (relative to your project's document root dir)
  .setPublicPath('/typo3conf/ext/template/Resources/Public/Build/')
  .enableSingleRuntimeChunk()
  .setManifestKeyPrefix('')
  // will output as web/build/app.js
  .addEntry('mia3_scripts', [assetPath + 'Scripts/Main.js'])
  .addStyleEntry('mia3_styles', [assetPath + 'Styles/Main.scss'])
  .addStyleEntry('mia3_rte', [assetPath + 'Styles/RichTextEditor.scss'])
  .enableVueLoader()
  .enableSassLoader()
  // .enablePostCssLoader()
  .enableSourceMaps(!Encore.isProduction());

// export the final configuration
module.exports = {
  root: assetPath,
  webpack: Encore.getWebpackConfig(),
};
