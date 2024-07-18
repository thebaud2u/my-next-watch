var theme = './';

module.exports = {
	plugins: {
		'tailwindcss/nesting': {},
		tailwindcss: { config: theme + 'tailwind.config.js'},
		autoprefixer: {},
	},
};
