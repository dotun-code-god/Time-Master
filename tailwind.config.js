/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js,php}", 
    "./public/**/*.{html,js,php}"
  ],
  theme: {
    extend: {
      fontFamily : {
        Poppins : ['Poppins', 'sans-serif']
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}

