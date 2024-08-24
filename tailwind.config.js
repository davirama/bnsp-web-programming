/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "../public/css/*.css",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        'custom-midnight': '#1D1A39',
        'custom-purple': '#451952',
        'custom-maroon': '#662549',
        'custom-red': '#B31312',
        'custom-pink': '#AE445A',
        'custom-light-pink': '#E8BCB9',
        'custom-yellow': '#F39F5A',
        'custom-dark-white': '#F2CBAC',
        'custom-white': '#F6F6F6',
      },
      fontFamily:{
        'urbanist': ["Urbanist", "sans-serif"],
        'manrope': ["Manrope", "sans-serif"],
        'public': ["Public Sans", "sans-serif"],
        'outfit': ["Outfit", "sans-serif"],
        'libreFranklin': ["Libre Franklin", "sans-serif"],
      }
    },
  },
  plugins: [
    require('flowbite/plugin')({
      charts: true,
  }),
    require('@tailwindcss/typography')
  ], 
}
