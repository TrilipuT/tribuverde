const webpack = require('webpack')
const failPlugin = require('webpack-fail-plugin')
const isExitOnError = process.env.BUILD_NOEXIT && process.env.BUILD_NOEXIT ==
  '1'
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

let plugins = []
if (!isExitOnError) {
  plugins.push(failPlugin)
}

module.exports = {
  output: {
    path: require('path').resolve('assets/built/javascripts'),
    filename: 'common.min.js',
    sourceMapFilename: 'common.min.js.map',
  },
  externals: {
    jquery: 'jQuery',
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
  optimization: {
    minimizer: [
      // we specify a custom UglifyJsPlugin here to get source maps in production
      new UglifyJsPlugin({
        cache: true,
        parallel: true,
        uglifyOptions: {
          compress: false,
          ecma: 6,
          mangle: true,
        },
        sourceMap: true,
      }),
    ],
  },
  plugins: plugins,
  devtool: 'source-map',
}