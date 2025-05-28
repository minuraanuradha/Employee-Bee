/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.{html,js}",
    "./public/**/*.{html,js}"
  ],
  theme: {
    extend: {
      colors: {
        orange: '#FF3F00',
        black: '#161616',
        darkgray: '#52555A',
        lightgray: '#999DA6',
        white: '#DCDCDC'
      },
      fontFamily: {
        roboto: ['Roboto Flex', 'sans-serif']
      }
    }
  },
  plugins: []
}