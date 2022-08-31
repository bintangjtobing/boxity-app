<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ mix('css/asset.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{$company->icon}}" type="image/png" sizes="64x64">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!!asset('dashboard/style.css?'.rand(10000,99999))!!}">
    <script src="https://kit.fontawesome.com/bf3b9c3659.js" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="side-menu layout-light overlayScroll" data-app>
    <div id="app"></div>
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
    <audio volume="1" src="https://res.cloudinary.com/boxity-id/video/upload/v1630482149/assets/success_elj2sh.mp3"
        id="ding"></audio>
    <audio src="https://res.cloudinary.com/boxity-id/video/upload/v1630483423/assets/fail_ak10ql.mp3"
        id="failding"></audio>
    <audio src="https://res.cloudinary.com/boxity-id/video/upload/v1630486546/assets/info_ltlu4q.mp3" id="info"></audio>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery/jquery-3.5.1.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery/jquery-ui.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/bootstrap/popper.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/bootstrap/bootstrap.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/moment/moment.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/accordion.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/autoComplete.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/Chart.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/charts.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/daterangepicker.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/drawer.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/dynamicBadge.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/dynamicCheckbox.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/feather.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/footable.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/fullcalendar@5.2.0.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/google-chart.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.countdown.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.filterizr.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.magnific-popup.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.mCustomScrollbar.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.peity.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery.star-rating-svg.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/leaflet.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/leaflet.markercluster.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/loader.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/message.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/moment.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/muuri.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/notification.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/popover.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/select2.full.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/slick.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/trumbowyg.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/wickedpicker.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/drag-drop.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/footable.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/full-calendar.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/googlemap-init.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/icon-loader.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/jvectormap-init.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/leaflet-init.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/main.js')!!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()

    </script>
    <script type="text/javascript">
        function turnOnDarkMode() {
            if ($('#sunmoon').hasClass('fa-moon')) {
                $('#sunmoon').removeClass('fa-moon');
                $('#sunmoon').addClass('fa-sun');
            } else {
                $('#sunmoon').removeClass('fa-sun');
                $('#sunmoon').addClass('fa-moon');
            }
            var darkMode = document.body;
            darkMode.classList.toggle('layout-dark');
        }
        jQuery(document).ready(function ($) {
            $('*[data-href]').on('click', function () {
                window.location = $(this).data("href");
            });
        });
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('[autofocus]').focus();
        });

    </script>

</body>

</html>
