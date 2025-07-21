/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['ui-sans-serif', 'system-ui'],
        'anton': ['Anton', 'sans-serif'],
      },
      colors: {
        customwhite: '#FCFEFE',
        customblue: '#239B9E',
        primary: '#135DFB',
        customred: '#CC191A',
      'footer-dark': '#404044',

      },
    },
  },
  plugins: [],
}
