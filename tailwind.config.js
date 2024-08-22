const colors = require('tailwindcss/colors')

module.exports = {
	content: [
		'./resources/assets/**/*.vue',
		'./resources/views/**/*.blade.php',
	],
	darkMode: 'media', // or 'media' or 'class'
	// prefix: '',
  // purge: [],
  theme: {
    extend: {
			colors: {
				dark: {
					DEFAULT: '#1e1d32',
					800: '#141329',
				},
				primary: '#91c27c',
				secondary: '#022f4e',

			},
			fontFamily: {
				//poppins: ['poppins', 'sans-serif']
			},
		},
  },
  variants: {
		extend: {},
	},
	safelist: [
		'active',
	],
  plugins: [],
}
