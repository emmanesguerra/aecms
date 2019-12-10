const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('core/Layouts/assets/js/admin/setting/setting-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/user/user-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/user/user-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/permission/permission-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/page/page-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/page/page-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/module/module-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/module/module-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/content/content-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/content/content-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/contactus/contactus-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/contactus/contactus-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/files/files-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/files/files-ext.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/navi/navigation-vue.js', 'public/core/js')
.js('core/Layouts/assets/js/admin/navi/navigation-ext.js', 'public/core/js')
.js('resources/js/admin/sliders/sliders-ext.js', 'public/js/admin')
.js('resources/js/admin/sliders/sliders-vue.js', 'public/js/admin')
.js('resources/js/admin/products/products-ext.js', 'public/js/admin')
.js('resources/js/admin/products/products-vue.js', 'public/js/admin')
.js('resources/js/app.js', 'public/js/templates/vue-ui.js')
    .sass('core/Layouts/assets/sass/app.scss', 'core/css/app.css');
