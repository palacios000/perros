module.exports = {
  content: [
	'public/site/*.php',
	'public/site/templates/*.php',
	'public/site/templates/**/*.php',
	'public/site/templates/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'perros-green': {  DEFAULT: '#4EA28A',  '50': '#C5E3DA',  '100': '#B7DCD2',  '200': '#9BCFC0',  '300': '#80C2AF',  '400': '#64B59E',  '500': '#4EA28A',  '600': '#3C7C6A',  '700': '#2A5649',  '800': '#173029',  '900': '#050B09'},
        'perros-brown': {  DEFAULT: '#8D756D',  '50': '#DED6D4',  '100': '#D5CCC8',  '200': '#C3B6B1',  '300': '#B1A09A',  '400': '#9F8A83',  '500': '#8D756D',  '600': '#6D5B55',  '700': '#4E403C',  '800': '#2E2624',  '900': '#0E0C0B'},
      },
      fontFamily: {
        'oswald': ['"Oswald", sans-serif;'], 
        'sans': ['"Open Sans", sans-serif;']
      },
      fontSize: {
        'xxl': '1.35rem',
        '2ll': '1.6rem'
      },
      borderWidth: {
        '28' : '28px'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    ],
}