const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./node_modules/flowbite/**/*.js',
	],

	theme: {
		extend: {
			screens: {
				'xs': '320px',
				's': '480px',
				/** Default '640px'. Why? @see https://www.leptidigital.fr/technologie/parts-marche-resolutions-ecrans-26797/ */
				'sm': '668px',//,
				/** Default '1280px'. Pub: format arche compatible Pulse */
				'xlsm': '1157px',
				'xlg': '1920px'
			},
			fontFamily: {
				sans: ['Manrope', ...defaultTheme.fontFamily.sans],
				'bebasneue': ['Bebas Neue', 'cursive', ...defaultTheme.fontFamily.sans],
				'inter': ['Manrope', ...defaultTheme.fontFamily.sans]
			},
			colors: {
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
					darkerblue: '#011736',
					darkblue: '#002C6A',
					lighterdarkblue: '#E5EEF3',
					blue: '#0082FF',
					darklightblue: '#007EB6',
					otherlightblue: '#CEE8FF',
					lightblue: '#E5F2FF',

					gray: '#909090',
					headergray: '#777777',
					lightgray: '#F8F8F8',
					lightergray: '#BCBCBC',
					transparentgray: '#DADADA',

					darkerwhite: '#cbcbcb',
					white: '#FFFFFF',

					black: '#000000',
					lightblack: '#262423',

					violet: '#6F1E82',
					lighterviolet: '#F1E8F2',

					green: '#27A982',
					lightgreen: '#A2FDA0',
					lightergreen: '#E9F6F2',

					darkyellow: '#EFB000',
					yellow: '#FFBC00',
					lightyellow: '#FFEE48',
					yellowfooter: '#FEE819',

					red: '#FF2C2C',
					lightred: '#FFE7E6',
					orange: '#FF9800',
				}
			},
		},
	},

	plugins: [
		require('@tailwindcss/forms'),
		require('flowbite/plugin'),
		require('tailwind-scrollbar'),
	],
};
