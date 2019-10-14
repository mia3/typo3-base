module.exports = {
  plugins: {
    'postcss-easy-import': {},
    'postcss-css-variables': {},
    'postcss-custom-media': {
      extensions: {
        '--screen-mb': '(min-width: 480px)',
        '--screen-tb': '(min-width: 768px)',
        '--screen-sm': '(min-width: 992px)',
        '--screen-md': '(min-width: 1200px)',
        '--screen-lg': '(min-width: 1600px)',
      },
    },
    'cssnext': {},
    'autoprefixer': {},
  },
};
