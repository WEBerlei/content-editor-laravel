const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [],
  theme: {
      extend: {
          fontFamily: {
              sans: ['Inter var', ...defaultTheme.fontFamily.sans],
          },
          colors: {
              'primary': {
                  100: '#FFF9F1',
                  200: '#FFF1DC',
                  300: '#FFE8C7',
                  400: '#FFD69D',
                  500: '#FFC573',
                  600: '#E6B168',
                  700: '#997645',
                  800: '#735934',
                  900: '#4D3B23',
              },
          }
      },
  },
  variants: {},
  plugins: [
      require('@tailwindcss/ui'),
      require('@tailwindcss/typography'),
  ],
}
