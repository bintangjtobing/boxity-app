const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js').vue();
mix.sass('resources/sass/app.scss', 'public/css');
mix.styles([
    'public/dashboard/assets/vendor_assets/css/bootstrap/bootstrap.css',
    'public/dashboard/assets/vendor_assets/css/daterangepicker.css',
    'public/dashboard/assets/vendor_assets/css/fontawesome.css',
    'public/dashboard/assets/vendor_assets/css/fullcalendar@5.2.0.css',
    'public/dashboard/assets/vendor_assets/css/jquery-jvectormap-2.0.5.css',
    'public/dashboard/assets/vendor_assets/css/jquery.mCustomScrollbar.min.css',
    'public/dashboard/assets/vendor_assets/css/leaflet.css',
    'public/dashboard/assets/vendor_assets/css/line-awesome.min.css',
    'public/dashboard/assets/vendor_assets/css/magnific-popup.css',
    'public/dashboard/assets/vendor_assets/css/MarkerCluster.css',
    'public/dashboard/assets/custom.css',
    'public/dashboard/assets/vendor_assets/css/MarkerCluster.Default.css',
    'public/dashboard/assets/vendor_assets/css/select2.min.css',
    'public/dashboard/assets/vendor_assets/css/slick.css',
    'public/dashboard/assets/vendor_assets/css/star-rating-svg.css',
    'public/dashboard/assets/vendor_assets/css/trumbowyg.min.css',
    'public/dashboard/assets/vendor_assets/css/wickedpicker.min.css',
], 'public/css/asset.css');
