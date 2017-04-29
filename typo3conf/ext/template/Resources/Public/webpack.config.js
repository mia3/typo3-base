let path = require('path');
let webpack = require('webpack');
let ExtractTextPlugin = require("extract-text-webpack-plugin");
let dir_js = path.resolve(__dirname, 'Scripts');
let dir_build = __dirname;
process.noDeprecation = true;

let extractPlugin = new ExtractTextPlugin({
    filename: "Styles/Main.compiled.css"
});

module.exports = {
    entry: './Scripts/Main.js',
    output: {
        path: dir_build,
        publicPath: '/typo3conf/ext/template/Resource/Public/',
        filename: 'Scripts/Main.compiled.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {}
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                options: {}
            },
            {
                test: /\.css/,
                loader: extractPlugin.extract({
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1
                            }
                        },
                        'postcss-loader'
                    ]
                })
            }
        ]
    },
    resolve: {
        modules: ['node_modules', dir_js],
        alias: {
            'vue$': 'vue/dist/vue',
            'BrunexBase': dir_brunex_base
        }
    },
    devServer: {
        historyApiFallback: true,
        noInfo: true
    },
    devtool: '#source-map',
    plugins: [
        extractPlugin
    ]
};

if (process.env.NODE_ENV === 'production') {
    module.exports.devtool = '#source-map';
    // http://vue-loader.vuejs.org/en/workflow/production.html
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false
            }
        }),
        new webpack.LoaderOptionsPlugin({
            minimize: true
        })
    ])
}
