var failPlugin = require('webpack-fail-plugin')
const isExitOnError = process.env.BUILD_NOEXIT && process.env.BUILD_NOEXIT ==
  '1'
var plugins = []

if (!isExitOnError) {
  plugins.push(failPlugin)
}

module.exports = {
  output: {
    path: require('path').resolve('../assets/built/javascripts'),
    filename: 'common.js',
    sourceMapFilename: 'common.js.map',
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
  plugins: plugins,
  devtool: 'source-map',
}