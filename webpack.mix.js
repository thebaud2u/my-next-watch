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
var theme = './';
mix.setPublicPath(theme);

/*
 * Allow Tailwind presets (child compilation)
 */
mix.webpackConfig({
	stats: {
		children: true
	}
});

// Compilation
mix.js(theme + 'resources/js/app.js', 'public/js')
	.js(theme + 'resources/js/uppy.js', 'public/js')
	.postCss(theme + 'resources/css/app.css', 'public/css', [require('tailwindcss')])
	.js(theme + 'resources/js/flowbite.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.min.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.css', 'public/css')
	// Tarteaucitron.js
	.copy('./node_modules/tarteaucitronjs/tarteaucitron.js', 'public/js/tarteaucitron')
	.copy('./node_modules/tarteaucitronjs/tarteaucitron.services.js', 'public/js/tarteaucitron')
	.copy('./node_modules/tarteaucitronjs/lang/tarteaucitron.fr.js', 'public/js/tarteaucitron/lang')
	.copy('./node_modules/tarteaucitronjs/css/tarteaucitron.css', 'public/js/tarteaucitron/css')
	.sourceMaps();

if (mix.inProduction()) mix.version();
