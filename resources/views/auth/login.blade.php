<!DOCTYPE html>
<html lang="en">

<head>
    <title>BTSA LOGISTICS - Authentication</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{!!asset('faviconv2.ico')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/bootstrap/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css')!!}">
    <link rel="stylesheet" type="text/css"
        href="{!!asset('auth/fonts/iconic/css/material-design-iconic-font.min.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/animate/animate.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/css-hamburgers/hamburgers.min.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/animsition/css/animsition.min.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/select2/select2.min.cs')!!}s">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/vendor/daterangepicker/daterangepicker.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/css/util.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/css/main.css')!!}">
    <meta name="description" content="Tools BTSA Logistics yang memiliki sistem Issue Reports Managements | Applicants Candidate Managements | Legality Documents | Jadwal Kapal
        Managements | Vessel Managements didalamnya.">
    <meta name="keywords"
        content="PPJK, EMKL, Expedisi, Export-Import, Custom Clearance, BTSA, BTSA LOGISTICS, Ekspedisi, Jasa Ekspedisi, applicants, job, issuereport, vessel">
    <meta name="author" content="Bintang Cato Jeremia L Tobing">
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <video autoplay muted loop id="myVideo">
                <source src="{!!asset('mov/overlay-btsa-1.mp4')!!}" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
            <div class="wrap-login100">
                <?php $tokens=bin2hex(openssl_random_pseudo_bytes(64));?>
                @if(session('gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('gagal')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="/login/{{$tokens}}" method="POST" class="login100-form validate-form">
                    {{ csrf_field() }}
                    <span class="login100-form-title p-b-16">
                        Welcome to<br>BTSA LOGISTICS
                    </span>
                    <span class="login100-form-title p-b-40">
                        <img src="{!!asset('faviconv2.ico')!!}" alt="BTSA LOGISTICS Authentication">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="{!!asset('auth/vendor/jquery/jquery-3.2.1.min.js')!!}"></script>
    <script src="{!!asset('auth/vendor/animsition/js/animsition.min.js')!!}"></script>
    <script src="{!!asset('auth/vendor/bootstrap/js/popper.js')!!}"></script>
    <script src="{!!asset('auth/vendor/bootstrap/js/bootstrap.min.js')!!}"></script>
    <script src="{!!asset('auth/vendor/select2/select2.min.js')!!}"></script>
    <script src="{!!asset('auth/vendor/daterangepicker/moment.min.js')!!}"></script>
    <script src="{!!asset('auth/vendor/daterangepicker/daterangepicker.js')!!}"></script>
    <script src="{!!asset('auth/vendor/countdowntime/countdowntime.js')!!}"></script>
    <script src="{!!asset('auth/js/main.js')!!}"></script>

</body>

</html>
