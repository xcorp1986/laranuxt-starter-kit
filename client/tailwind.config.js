/*
 ** TailwindCSS Configuration File
 **
 ** Docs: https://tailwindcss.com/docs/configuration
 ** Default: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js
 */
module.exports = {
  theme: {
    container: {
      center: true,
      padding: '1.5rem'
    }
  },
  variants: {
    borderWidth: ['last']
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
    function({ addUtilities }) {
      addUtilities({
        '.gradient': {
          background: 'linear-gradient(90deg, #d53369 0%, #daae51 100%)'
        }
      })
    }
  ]
}
