let mix = require('laravel-mix');
mix.setPublicPath('../assets');

mix.js('js/app.js', 'js').sass('scss/style.scss', 'css/style.min.css');

// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });

// Disable mix-manifest.json
Mix.manifest.refresh = (_) => void 0;
