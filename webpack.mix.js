const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*
 * Mix param "theme" :
 * use "$ npm run [dev|prod|watch|watch-poll]"  => default "resources" path and "public" export path
 * or use "$ npm run [dev|prod|watch|watch-poll] --theme=tema/main"  => use and export "main theme" assets
 */
mix.setPublicPath('public');

/*
 * Allow Tailwind presets (child compilation)
 */
mix.webpackConfig({
	stats: {
		children: true
	}
});

// Compilation
mix.js('resources/js/app.js', 'public/js')
	.js('resources/js/uppy.js', 'public/js')
	.postCss('resources/css/app.css', 'public/css', [require('tailwindcss')])
	.js('resources/js/flowbite.js', 'public/js')
	.js('resources/js/datepicker.js', 'public/js')
	.copy('resources/js/ckeditor.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.min.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.css', 'public/css')
	.sourceMaps();

if (mix.inProduction()) mix.version();
