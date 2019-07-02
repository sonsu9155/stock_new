<?php

/*
|---------------------------------------------------------------------------
| Here are SOME of the available configuration options with suitable values.
| Uncomment and customize those you want to override or remove them to
| use their default values. For a FULL list of options please visit
| https://github.com/Stolz/Assets/blob/master/API.md#assets
|---------------------------------------------------------------------------
 */

return [

    // Configuration for the default group. Feel free to add more groups.
    // Each group can have different settings.
    'default' => [

        /**
         * Regex to match against a filename/url to determine if it is an asset.
         *
         * @var string
         */
        //'asset_regex' => '/.\.(css|js)$/i',

        /**
         * Regex to match against a filename/url to determine if it is a CSS asset.
         *
         * @var string
         */
        //'css_regex' => '/.\.css$/i',

        /**
         * Regex to match against a filename/url to determine if it is a JavaScript asset.
         *
         * @var string
         */
        //'js_regex' => '/.\.js$/i',

        /**
         * Regex to match against a filename/url to determine if it should not be minified by pipeline.
         *
         * @var string
         */
        //'no_minification_regex' => '/.[-.]min\.(css|js)$/i',

        /**
         * Absolute path to the public directory of your App (WEBROOT).
         * Required if you enable the pipeline.
         * No trailing slash!.
         *
         * @var string
         */
        //'public_dir' => (function_exists('public_path')) ? public_path() : '/var/www/localhost/htdocs',

        /**
         * Directory for local CSS assets.
         * Relative to your public directory ('public_dir').
         * No trailing slash!.
         *
         * @var string
         */
        'css_dir' => '',

        /**
         * Directory for local JavaScript assets.
         * Relative to your public directory ('public_dir').
         * No trailing slash!.
         *
         * @var string
         */
        'js_dir' => '',

        /**
         * Directory for local package assets.
         * Relative to your public directory ('public_dir').
         * No trailing slash!.
         *
         * @var string
         */
        //'packages_dir' => 'packages',

        /**
         * Enable assets pipeline (concatenation and minification).
         * Use a string that evaluates to `true` to provide the salt of the pipeline hash.
         * Use 'auto' to automatically calculated the salt from your assets last modification time.
         *
         * @var bool|string
         */
        'pipeline' => false,

        /**
         * Directory for storing pipelined assets.
         * Relative to your assets directories ('css_dir' and 'js_dir').
         * No trailing slash!.
         *
         * @var string
         */
        //'pipeline_dir' => 'min',

        /**
         * Enable pipelined assets compression with Gzip.
         * Use only if your webserver supports Gzip HTTP_ACCEPT_ENCODING.
         * Set to true to use the default compression level.
         * Set an integer between 0 (no compression) and 9 (maximum compression) to choose compression level.
         *
         * @var bool|integer
         */
        //'pipeline_gzip' => false,

        /**
         * Closure used by the pipeline to fetch assets.
         *
         * Useful when file_get_contents() function is not available in your PHP
         * instalation or when you want to apply any kind of preprocessing to
         * your assets before they get pipelined.
         *
         * The closure will receive as the only parameter a string with the path/URL of the asset and
         * it should return the content of the asset file as a string.
         *
         * @var Closure
         */
        //'fetch_command' => function ($asset) {return preprocess(file_get_contents($asset));},

        /**
         * Available collections.
         * Each collection is an array of assets.
         * Collections may also contain other collections.
         *
         * @var array
         */
        'collections' => [
            'google_fonts' => ['https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext', 'https://fonts.googleapis.com/icon?family=Material+Icons'],
            'jquery' => ['bsb/plugins/jquery/jquery.min.js'],
            'bootstrap' => ['bsb/plugins/bootstrap/css/bootstrap.css', 'bsb/plugins/bootstrap/js/bootstrap.min.js'],
            'waves' => ['bsb/plugins/node-waves/waves.min.css', 'bsb/plugins/node-waves/waves.min.js'],
            'validation' => ['bsb/plugins/jquery-validation/jquery.validate.js'],
            'default_style' => ['bsb/plugins/animate-css/animate.min.css', 'bsb/css/style.css', 'bsb/js/admin.js'],
            'default' => ['bootstrap', 'waves', 'validation', 'default_style'],
            'theme' => ['bsb/css/themes/all-themes.min.css'],
            'preloader' => ['bsb/plugins/material-design-preloader/md-preloader.min.css'],
            'sweetalert' => ['bsb/plugins/sweetalert-dev.js', 'bsb/plugins/sweetalert/sweetalert.css'],
            'slimscroll' => ['bsb/plugins/jquery-slimscroll/jquery.slimscroll.min.js'],
            'datatable' => ['bsb/plugins/jquery-datatable/extensions/button/buttons.dataTables.min.css', 'bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css', 'bsb/plugins/jquery-datatable/jquery.dataTables.js', 'bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js', 'bsb/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js', 'bsb/plugins/jquery-datatable/extensions/export/buttons.flash.min.js', 'bsb/plugins/jquery-datatable/extensions/export/jszip.min.js', 'bsb/plugins/jquery-datatable/extensions/export/pdfmake.min.js', 'bsb/plugins/jquery-datatable/extensions/export/vfs_fonts.js', 'bsb/plugins/jquery-datatable/extensions/export/buttons.html5.min.js', 'bsb/plugins/jquery-datatable/extensions/export/buttons.print.min.js', 'bsb/plugins/jquery-datatable/extensions/button/buttons.colVis.min.js'],
            'chartjs' => ['bsb/plugins/chartjs/Chart.bundle.js'],
            'moment' => ['bsb/plugins/momentjs/moment.js'],
            'daterangepicker' => ['bsb/plugins/bootstrap-daterangepicker2/daterangepicker.js', 'bsb/plugins/bootstrap-daterangepicker2/daterangepicker.css'],
            'default_admin' => ['bootstrap', 'waves', 'slimscroll', 'preloader', 'default_style', 'bsb/js/demo.js', 'bsb/js/script.js'],
        ],
        /*'collections' => array(

        // jQuery (CDN)
        'jquery-cdn' => array('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'),

        // jQuery UI (CDN)
        'jquery-ui-cdn' => array(
        'jquery-cdn',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
        ),

        // Twitter Bootstrap (CDN)
        'bootstrap-cdn' => array(
        'jquery-cdn',
        '//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css',
        '//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css',
        '//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
        ),

        // Zurb Foundation (CDN)
        'foundation-cdn' => array(
        'jquery-cdn',
        '//cdn.jsdelivr.net/foundation/5.3.3/css/normalize.css',
        '//cdn.jsdelivr.net/foundation/5.3.3/css/foundation.min.css',
        '//cdn.jsdelivr.net/foundation/5.3.3/js/foundation.min.js',
        'app.js'
        ),

        ),*/

        /**
         * Preload assets.
         * Here you may set which assets (CSS files, JavaScript files or collections)
         * should be loaded by default even if you don't explicitly add them on run time.
         *
         * @var array
         */
        'autoload' => ['default_admin'],

    ], // End of default group
];
