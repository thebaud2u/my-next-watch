const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./node_modules/flowbite/**/*.js',
		'./app/Http/Livewire/**/*.php',
	],

	theme: {
		extend: {
			screens: {
				'xs': '320px',
				'xsdc': '367px',
				'xseol': '390px',
				's': '480px',
				'dc': '572px',
				/** Default '640px'. Why? @see https://www.leptidigital.fr/technologie/parts-marche-resolutions-ecrans-26797/ */
				'sm': '668px',
				'lmd': '840px',
				/** Default '1280px'. Pub: format arche compatible Pulse */
				'xlsm': '1157px',
				'xlmd': '1440px',
				'xlhome': '1766px',
				'xlg': '1920px'
			},
			fontFamily: {
				sans: ['Poppins', 'sans-serif', ...defaultTheme.fontFamily.sans],
				'inter': ['Poppins', 'sans-serif', ...defaultTheme.fontFamily.sans]
			},
			colors: {
				/** Tema bluescale */
				primary: {
					50: '#eff9ff',
					100: '#cbe8ff',
					200: '#96cdff',
					300: '#59aeff',
					400: '#2594ff',
					500: '#0082ff',
					600: '#0071e0',
					700: '#0057b4',
					800: '#003e88',
					900: '#002c6a',
				},
				info: colors.sky,
				success: colors.green,
				warning: colors.yellow,
				danger: colors.red,
				gray: colors.zinc,
				/*
					Keep colors separated from each other.
					Darker color ^
					Color
					Lighter color v
				*/
				mnw: {
					deepblue: '#0E1954',
					deepbluehover: '#08103A',
					blue: '#0082FF',
					coral: '#FF7E71',
					coralhover: '#EB6355',
					lightgreen: '#3FCE4F',
					green: '#3DD8AC',
					greenhover: '#26C89A',
					orange: '#FFA244',
					darkorange: '#F29334',
					cream: '#F7F6EF',
					lightcream: '#F7F6EF',
					darkviolet: '#C68CFF33',
					violet: '#C68CFF',
					violethover: '#AA5FF6',
					lightviolet: '#E4C9FF',
					greige: '#E2E0D2',
					figo: '#D7F6F4',
					yellow: '#FFE500'
				}
			},
			aspectRatio: {
				'100/57': '100 / 57',
				'100/61': '100 / 61',
				'100/75': '100 / 75',
			},
		},
	},

	plugins: [
		require('@tailwindcss/forms'),
		require('flowbite/plugin'),
		require('tailwind-scrollbar'),
		function ({ addVariant }) {
			addVariant('placeholder', '&::placeholder');
		},
	],
};
