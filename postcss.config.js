module.exports = {
  plugins: {
    'postcss-easy-import': {},
    'postcss-css-variables': {
      options:{
        preserve: true
      }
    },
    'postcss-custom-media': {
      extensions: {
        '--screen-mobile': '(min-width: 480px)',
        '--screen-tablet': '(min-width: 768px)',
        '--screen-tablet-landscape': '(min-width: 992px)',
        '--screen-desktop': '(min-width: 1200px)',
      },
    },
    'cssnext': {},
    'autoprefixer': {},
  },
};
