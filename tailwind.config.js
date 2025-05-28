/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.{html,js}", // Include all HTML and JS files in resources/views
    "./public/**/*.{html,js}"          // Include all HTML and JS files in public
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1D4ED8', 
        secondary: '#F3F4F6', 
        accent: '#10B981'
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif']
      }
    }
  },
  plugins: []
}