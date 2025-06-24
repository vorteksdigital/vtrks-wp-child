const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin'); 

module.exports = {
  entry: {
    script: './assets/js/main.js',    // JS entry point
    main: './assets/scss/style.scss'  // SCSS entry point
  },
  output: {
    filename: (pathData) => {
      return pathData.chunk.name === 'script' ? 'js/script.js' : 'js/[name].js';
    },
    path: path.resolve(__dirname, 'dist'),
    clean: true
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ],
      },
      {
        test: /\.js$/,
        exclude: /node_modules/
      }
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: (pathData) => {
        return pathData.chunk.name === 'main' ? 'css/main.css' : 'css/[name].css';
      }
    }),
    new CopyPlugin({
      patterns: [
        { from: 'assets/img', to: 'img', noErrorOnMissing: true },       // copies assets/img -> dist/img
        { from: 'assets/fonts', to: 'fonts', noErrorOnMissing: true },   // copies assets/fonts -> dist/fonts
      ],
    }),
  ],
  mode: 'production',
  watch: true,
};
