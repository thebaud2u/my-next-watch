const mix = require('laravel-mix');

mix.setPublicPath('public');

mix.webpackConfig({
	stats: {
		children: true
	}
});

mix.js('resources/js/app.js', 'public/js')
	.js('resources/js/uppy.js', 'public/js')
	.postCss('resources/css/app.css', 'public/css', [require('tailwindcss')])
	.js('resources/js/flowbite.js', 'public/js')
	.js('resources/js/datepicker.js', 'public/js')
	.copy('resources/js/ckeditor.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.min.js', 'public/js')
	.copy('./node_modules/flowbite/dist/flowbite.css', 'public/css')
	.sourceMaps();

if (mix.inProduction()) {
	mix.version();
}
