<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ mix('css/asset.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{!!asset('faviconv2.ico')!!}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!!asset('dashboard/style.css')!!}">
    <script src="https://kit.fontawesome.com/bf3b9c3659.js" crossorigin="anonymous"></script>
</head>

<body class="side-menu">
    <div class="mobile-search"></div>
    <div class="mobile-author-actions"></div>
    <header class="header-top">
        <nav class="navbar navbar-light">
            <div class="navbar-left">
                <a href="" class="sidebar-toggle">
                    <img class="svg" src="{!!asset('dashboard/img/svg/bars.svg')!!}" alt="img"></a>
                <a class="navbar-brand" href="#"><img class="svg dark" src="{!!asset('dashboard/img/logo_Dark.png')!!}"
                        alt="logo BTSA Logistics"><img class="light" src="{!!asset('dashboard/img/Logo_white.png')!!}"
                        alt="logo BTSA Logistics"></a>
            </div>
            <!-- ends: navbar-left -->
            <div class="navbar-right">
                <ul class="navbar-right__menu">
                    <li>
                        <button class="btn" onclick="turnOnDarkMode()"><span>
                                <div id="sunmoon" class="fas fa-moon"></div>
                            </span></button>
                    </li>
                    <li class="nav-message">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <i data-feather="mail"></i></a>
                            <div class="dropdown-wrapper">
                                <h2 class="dropdown-wrapper__title">Messages <span
                                        class="badge-circle badge-success ml-1">2</span></h2>
                                <ul>
                                    <li class="author-online has-new-message">
                                        <div class="user-avater">
                                            <img src="{!!asset('dashboard/img/author/profile/1.jpg')!!}" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem
                                                    ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline has-new-message">
                                        <div class="user-avater">
                                            <img src="{!!asset('dashboard/img/author/profile/2.jpg')!!}" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem
                                                    ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message">
                                        <div class="user-avater">
                                            <img src="{!!asset('dashboard/img/author/profile/3.jpg')!!}" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem
                                                    ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline">
                                        <div class="user-avater">
                                            <img src="{!!asset('dashboard/img/author/profile/4.jpg')!!}" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem
                                                    ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline">
                                        <div class="user-avater">
                                            <img src="{!!asset('dashboard/img/author/profile/5.jpg')!!}" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem
                                                    ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="dropdown-wrapper__more">See All Message</a>
                            </div>
                        </div>
                    </li>
                    <!-- ends: nav-message -->
                    <li class="nav-notification">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <i data-feather="bell"></i></a>
                            <div class="dropdown-wrapper">
                                <h2 class="dropdown-wrapper__title">Notifications <span
                                        class="badge-circle badge-warning ml-1">4</span></h2>
                                <ul>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--primary">
                                            <i data-feather="inbox"></i>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--secondary">
                                            <i data-feather="upload"></i>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--success">
                                            <i data-feather="log-in"></i>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--info">
                                            <i data-feather="at-sign"></i>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--danger">
                                            <i data-feather="heart"></i>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="dropdown-wrapper__more">See all incoming activity</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img
                                    src="{!!asset('dashboard/img/author/profile/'.auth()->user()->avatar)!!}"
                                    alt="User avatar" class="rounded-circle"></a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img">
                                        <img src="{!!asset('dashboard/img/author/profile/'.auth()->user()->avatar)!!}"
                                            alt="User avatar" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6>{{auth()->user()->name}}</h6>
                                        <span>{{auth()->user()->divisi}}</span>
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    <ul>
                                        <li>
                                            <a href="/{{auth()->user()->username}}/edit">
                                                <i data-feather="user"></i> Profile</a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i data-feather="settings"></i> Settings</a>
                                        </li>
                                    </ul>
                                    <a href="/sign-out" class="nav-author__signout">
                                        <i data-feather="log-out"></i> Sign Out</a>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
        </nav>
    </header>
    <main class="main-content">
        <aside class="sidebar">
            <div class="sidebar__menu-group">
                <ul class="sidebar_nav">
                    <li class="menu-title">
                        <span>Main menu</span>
                    </li>
                    <li>
                        <a href="/tools" active-class="mm-active">
                            <i data-feather="home" class="nav-icon"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/version-control" active-class="mm-active">
                            <i data-feather="activity" class="nav-icon"></i>
                            <span class="menu-text">Version control</span>
                            <span class="badge badge-danger menuItem">3.0.0</span>
                        </a>
                    </li>
                    <li class="menu-title m-top-30">
                        <span>Applications</span>
                    </li>
                    @if(auth()->user()->role=='admin')
                    <li>
                        <a href="/users-management" active-class="mm-active">
                            <i data-feather="users" class="nav-icon"></i>
                            <span class="menu-text">Users management</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="/contact-list" active-class="mm-active">
                            <i data-feather="list" class="nav-icon"></i>
                            <span class="menu-text">Contact lists</span>
                        </a>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <i data-feather="rss" class="nav-icon"></i>
                            <span class="menu-text">Human resources</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul>
                            <li>
                                <a active-class="mm-active" href="/career">Career</a>
                            </li>
                            <li>
                                <a active-class="mm-active" href="/candidate">Candidate</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/issues" active-class="mm-active">
                            <i data-feather="headphones" class="nav-icon"></i>
                            <span class="menu-text">Issue center</span>
                        </a>
                    </li>
                    <li>
                        <a href="/quote" active-class="mm-active">
                            <i data-feather="star" class="nav-icon"></i>
                            <span class="menu-text">Quote report</span>
                        </a>
                    </li>
                    <li>
                        <a href="/gallery" active-class="mm-active">
                            <i data-feather="image" class="nav-icon"></i>
                            <span class="menu-text">Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="/blog-management" active-class="mm-active">
                            <i data-feather="package" class="nav-icon"></i>
                            <span class="menu-text">Blog</span>
                        </a>
                    </li>
                    <li>
                        <a href="/track-delivery" active-class="mm-active">
                            <i data-feather="map" class="nav-icon"></i>
                            <span class="menu-text">Track delivery</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div id="App">
            <div class="contents">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <footer class="footer-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <?php $y = Date('Y'); ?>
                            <p>&copy; Copyright {{$y}} -<a href="/" target="_blank">BTSA LOGISTICS</a> | All
                                reserved
                                by<a href="https://infinitysolutions.co.id">Infinity Solutions</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-menu text-right">
                            <ul>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="mailto:support@btsa.co.id">Contact support</a>
                                </li>
                            </ul>
                        </div>
                        <!-- ends: .Footer Menu -->
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery/jquery-3.5.1.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/jquery/jquery-ui.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/bootstrap/popper.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/bootstrap/bootstrap.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/accordion.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/autoComplete.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/Chart.min.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/charts.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/daterangepicker.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/drawer.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/dynamicBadge.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/vendor_assets/js/dynamicCheckbox.js')!!}"></script>
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
    <script src="{!!asset('dashboard/assets/theme_assets/js/full-calendar.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/googlemap-init.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/icon-loader.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/jvectormap-init.js')!!}"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/leaflet-init.js')!!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="{!!asset('dashboard/assets/theme_assets/js/main.js')!!}"></script>
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

    </script>
</body>

</html>
