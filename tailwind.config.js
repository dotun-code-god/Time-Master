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
      },
      colors: {
        yip_black: '#212529',
        yip_blue: '#2289ce',
        yip_green: '#b5d75c',
        yip_red: '#ce2222'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}

