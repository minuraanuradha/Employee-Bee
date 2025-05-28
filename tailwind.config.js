/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.html",
    "./public/*.html"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1D4ED8', 
        secondary: '#F3F4F6', 
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif']
      }
    }
  },
  plugins: []
}