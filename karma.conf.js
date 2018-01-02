const Encore = require('@symfony/webpack-encore');
const ManifestPlugin = require('@symfony/webpack-encore/lib/webpack/webpack-manifest-plugin');

// Initialize Encore before requiring the .config file
Encore.configureRuntimeEnvironment('dev-server');

// Retrieve webpack config
const webpackConfig = require('./webpack.config');

// Set writeToFileEmit option of the ManifestPlugin to false
for (const plugin of webpackConfig.plugins) {
    if ((plugin instanceof ManifestPlugin) && plugin.opts) {
        plugin.opts.writeToFileEmit = false;
    }
}

// Remove entry property (handled by Karma)
delete webpackConfig.entry;


module.exports = function(config) {
  config.set({

    // base path that will be used to resolve all patterns (eg. files, exclude)
    basePath: 'web/typo3conf/ext/template/Resources/Private/Assets/',

    // frameworks to use
    // available frameworks: https://npmjs.org/browse/keyword/karma-adapter
    frameworks: ['jasmine'],

    // list of files / patterns to load in the browser
    files: [
      'Scripts/Tests/**/*.js'
    ],

    // list of files to exclude
    exclude: [
    ],
    webpack: webpackConfig,

    preprocessors: {
        'Tests/**/*.js': ['webpack']
    },

    reporters: ['progress'],

    plugins: [
        require('karma-webpack'),
        require('karma-jasmine'),
        require('karma-phantomjs-launcher'),
        require('karma-spec-reporter')
    ],

    port: 9876,

    colors: true,

    logLevel: config.LOG_INFO,

    autoWatch: true,

    browsers: ['PhantomJS'],

    singleRun: true,

    concurrency: Infinity
  })
}
