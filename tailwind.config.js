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
				primary: {
					100: '#ffe5ea',
					200: '#ffb3c0',
					300: '#ff8096',
					400: '#ff4d6c',
					500: '#ff1a42',
					600: '#e60028',
					DEFAULT: '#e60028',
					700: '#b3001f',
					800: '#b3001f',
					900: '#b3001f',
				},
				secondary: colors.cyan[400],
				link: {
					DEFAULT: colors.sky[700],
					dark: colors.sky[400],
				},
				muted: colors.gray[400],
				facebook: '#1877f2',
				instagram: '#c32aa3',
				twitter: '#1da1f2',
				pinterest: '#bd081c',
				linkedin: '#0a66c2',
				youtube: '#ff0000',
			},
			fontFamily: {
				poppins: ['poppins', 'sans-serif']
			},
			screens: {
				'xs': '480px',
				//sm	640px
				//md	768px
				'bg': '890px',
				//lg	1024px
				//xl	1280px
				//2xl	1536px
			},
			width: {
				17: '4.25rem', // 68px
				68: '17rem', // 272px
				74: '18.5rem', // 296px
			},
			maxWidth: {
				200: '50rem', // 800px
			},
			height: {
			},
			maxHeight: {
				55: '13.75rem', // 220px
				74: '18.5rem', // 296px
				79: '19.75rem', // 316px
				93: '23.25rem', // 372px
				110: '27.5rem', // 440px
			},
			'aspectRatio': {
				card: '16/9',
				'card-small': '4/3',
			}
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
