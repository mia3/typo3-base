// webpack.config.js
let Encore = require('@symfony/webpack-encore');
const path = require('path');
const { table } = require('table');
process.env.NODE_ENV = Encore.isProduction() ? 'production' : 'development';

// Represents a package in the "packages"-directory where a CSS and JS Assets need to be compiled.
const packages = ['template'];
const data = [
  ['Package', 'Public-Path', 'Src-Folder', 'Aliases', 'Build-Context']
];
const alias = {};

const envs = packages.map(function (packageName) {
  const extension = require(`./webpack/${packageName}.webpack.config.js`);
  extension.name = packageName;
  extension.alias = '@' + packageName;
  extension.relRoot = extension.root;
  extension.root = path.resolve(__dirname, extension.root);

  // gathering aliases, so every extension can load resources from each other.
  // Use case described below
  alias[extension.alias] = extension.root;

  // By loading/requiring the webpack config above the code in the module will be executed as well.
  // The reset prevents that all the configuration from the previous package wont mess up anything
  // in the next webpack.config we load.
  Encore.reset();
  return extension;
});

module.exports = envs.map(function (env, index) {
  // if other aliases exists, we still want to keep them.
  const existingAliases = env.webpack.resolve.alias;
  // This will set an global alias in webpack to your asset root path
  // with this alias you are able to import scripts or VueComponents from other packages more easily.
  // So instead of doing
  //      import myAwesomeComponent from '../../../up/up/we/go/packages/my_package/asset/javascript/Components/FancyComponent.vue'
  // you can do this
  //      import myAwesomeComponent from '@my_package/javascript/Components/FancyComponent.vue'
  env.webpack.resolve.alias = {
    ...existingAliases,
    ...alias
  };

  env.webpack.name = env.name;
  data.push([
    env.name,
    env.webpack.output.publicPath,
    env.relRoot,
    Object.keys(env.webpack.resolve.alias).reduce((acc, key) => acc + `${key} => ${env.webpack.resolve.alias[key]}\n`, ''),
    Encore.isProduction() ? '\x1b[32mProduction\x1b[0m' : '\x1b[33mDevelopment\x1b[0m'
  ]);
  if ((index + 1) === packages.length) {
    console.log(table(data));
  }
  return env.webpack;
});
