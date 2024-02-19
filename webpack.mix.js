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

mix.js('assets/js/app.js', 'public/js/init.js').vue()
    .sass('assets/sass/app.scss', 'public/css/init.css')
    .combine([
      'public/js/init.js',
        'assets/plugins/AdminLTE/plugins/pace/pace.min.js',
    	// 'assets/plugins/jquery-ui/jquery-ui.min.js',
    	'assets/plugins/bootstrap/js/bootstrap.min.js',
    	'assets/plugins/AdminLTE/plugins/select2/select2.full.min.js',
    	'assets/plugins/AdminLTE/plugins/datepicker/bootstrap-datepicker.min.js',
    	'assets/plugins/AdminLTE/plugins/DataTables/datatables.min.js',
    	'assets/plugins/AdminLTE/plugins/DataTables/pdfmake-0.1.32/pdfmake.min.js',
    	'assets/plugins/AdminLTE/plugins/DataTables/pdfmake-0.1.32/vfs_fonts.js',
    	'assets/plugins/jquery-validation-1.16.0/dist/jquery.validate.min.js',
    	'assets/plugins/jquery-validation-1.16.0/dist/additional-methods.min.js',
    	'assets/plugins/toastr/toastr.min.js',
    	'assets/plugins/bootstrap-fileinput/fileinput.min.js',
    	'assets/plugins/accounting.min.js',
    	// 'assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
    	// 'assets/plugins/AdminLTE/plugins/daterangepicker/daterangepicker.js',
    	'assets/plugins/mousetrap/mousetrap.min.js',
    	'assets/plugins/sweetalert/sweetalert.min.js',
    	'assets/plugins/bootstrap-tour/bootstrap-tour.min.js',
    	'assets/plugins/printThis.js',
    	'assets/plugins/AdminLTE/js/AdminLTE-app.js',
    	'assets/plugins/calculator/calculator.js',
    	'assets/plugins/dropzone/dropzone.js',
    	'assets/plugins/jquery.steps/jquery.steps.min.js',
        'assets/plugins/fullcalendar/fullcalendar.min.js',
        'assets/plugins/fullcalendar/locale-all.js',
        'assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js',
        'assets/plugins/decimal.min.js',
        'assets/plugins/jKanban/jKanbanBoard.js',
        'node_modules/onscan.js/onscan.min.js',
        'assets/plugins/jquery.top_scrollbar.js'
	], 'public/js/vendor.js')
  .combine([
    'public/css/init.css',
		'assets/plugins/AdminLTE/plugins/pace/pace.css',
		'assets/plugins/jquery-ui/jquery-ui.min.css',
		'assets/plugins/bootstrap/css/bootstrap.min.css',
		'assets/plugins/ionicons/css/ionicons.min.css',
		'assets/plugins/AdminLTE/plugins/select2/select2.min.css',
		'assets/plugins/AdminLTE/css/AdminLTE.min.css',
		// 'assets/plugins/AdminLTE/plugins/datepicker/bootstrap-datepicker.min.css',
		'assets/plugins/AdminLTE/plugins/DataTables/datatables.min.css',
		'assets/plugins/toastr/toastr.min.css',
		'assets/plugins/bootstrap-fileinput/fileinput.min.css',
		'assets/plugins/AdminLTE/css/skins/_all-skins.min.css',
		// 'assets/plugins/AdminLTE/plugins/daterangepicker/daterangepicker.css',
		'assets/plugins/bootstrap-tour/bootstrap-tour.min.css',
		'assets/plugins/calculator/calculator.css',
		// 'assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
		'assets/plugins/dropzone/dropzone.min.css',
		'assets/plugins/jquery.steps/jquery.steps.css',
        'assets/plugins/custom.css',
        'assets/plugins/fullcalendar/fullcalendar.min.css',
        'assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css',
        'assets/plugins/jKanban/jKanbanBoard.css',
        'assets/plugins/css-toggle-switch/toggle-switch.css'
	], 'public/css/vendor.css')
    .combine([
        'assets/plugins/AdminLTE/css/AdminLTE.rtl.min.css',
        'assets/plugins/bootstrap/css/bootstrap.rtl.min.css'
    ], 'public/css/rtl.css')
    .copy('assets/plugins/bootstrap/fonts/glyphicons-halflings-regular.woff2', 'public/fonts/')
    .copy('assets/plugins/bootstrap/fonts/glyphicons-halflings-regular.woff', 'public/fonts/')
    .copy('assets/plugins/bootstrap/fonts/glyphicons-halflings-regular.ttf', 'public/fonts/')
    .copy('assets/plugins/ionicons/fonts/ionicons.ttf', 'public/fonts/ionicons.ttf')
    .copyDirectory('node_modules/tinymce/skins/', 'public/js/skins/')
    .copyDirectory('node_modules/tinymce/icons/', 'public/js/icons/')
    .setResourceRoot('../');
