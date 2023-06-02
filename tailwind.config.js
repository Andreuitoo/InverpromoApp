const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    // prettier-ignore
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      red: colors.red,
      orange: colors.orange,
      yellow: colors.yellow,
      green: {
        100: '#DAFAE6',
        200: '#BAF6CF',
        300: '#4ADE80',
        400: '#22C55E',
        500: '#4ADE80',
        600: '#16A24B',
        700: '#158041',
        800: '#14522E',
        900: '#052E16',
        950: '#ECFDF5',
      },
      emerald: {
        100: '#A4F0D0',
        200: '#6DE6B7',
        300: '#6EE6B7',
        400: '#10B981',
        500: '#059669',
        600: '#A6F2D0',
        700: '#047959',
        800: '#064E3B',
        900: '#022C22',
        950: '#F0FDFA',
      },
      gray: colors.blueGray,
      indigo: {
        100: '#e6e8ff',
        300: '#b2b7ff',
        400: '#7886d7',
        500: '#6574cd',
        600: '#5661b3',
        800: '#2f365f',
        900: '#191e38',
      },
    },
    extend: {
      borderColor: theme => ({
        DEFAULT: theme('colors.gray.200', 'currentColor'),
      }),
      fontFamily: {
        sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
      },
      boxShadow: theme => ({
        outline: '0 0 0 2px ' + theme('colors.green.500'),
      }),
      fill: theme => theme('colors'),
    },
  },
  variants: {
    extend: {
      fill: ['focus', 'group-hover'],
    },
  },
  plugins: [],
}
