<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Bintang Tobing">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{$company->company_id}} - Authentication</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/css/my-login.css')!!}">
    <link rel="shortcut icon" href="{!!asset('icon.png')!!}" type="image/png" sizes="64x64">
    <meta name="description" content="{{$company->meta_description}}">
    <meta name="keywords" content="{{$company->meta_keywords}}">

</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="brand">
                <img src="{!!asset('auth/img/logoboxity.png')!!}" alt="boxity + {{$company->company_id}}">
            </div>
            <div class="row align-items-center">

                <div class="col-6 mx-auto mt-5">
                    <div class="">
                        <img style="height: 350px" src="{!!asset('auth/img/illustration.png')!!}"
                            alt="boxity + {{$company->company_id}}">
                    </div>
                </div>
                <div class="col-6 mx-auto">
                    <div class="">

                        <div class="">
                            <div class="card-body p-4">
                                <h1 class="card-title">Sign In</h1>
                                <p class="text-secondary">
                                    This page is protected by reCAPTCHA and subject to
                                    the Google Privacy Policy and Terms of service.
                                </p>
                                @if(session('gagal'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{session('gagal')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form method="POST" action="/login/{{csrf_token()}}">
                                    @csrf
                                    <div class="form-group bg-input-new px-2 py-2 rounded">
                                        <label for="email" class="text-secondary">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control input-style"
                                            style="border: none; background: transparent" name="email" value="" required
                                            autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            Email is invalid
                                        </div>
                                    </div>

                                    <div class="form-group bg-input-new px-2 py-2 rounded">
                                        <label for="password" class="text-secondary">Password</label>
                                        <input id="password" type="password" class="form-control input-style"
                                            style="border: none; background: transparent" name="password" required>
                                        <div class="invalid-feedback">
                                            Password is required
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" name="remember" id="remember"
                                                        class="custom-control-input">
                                                    <label for="remember" class="custom-control-label">Remember
                                                        Me</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="password">
                                                <a href="/forgot-password" class="text-right text-secondary"
                                                    style="text-decoration: none">
                                                    Forgot/Reset Password?
                                                </a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit"
                                            class="btn bg-orange btn-block py-4 px-3 text-white font-weight-bold">
                                            Sign In
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer">
                            &copy;<?php $y = date('Y'); echo $y; ?> - Boxity Central Indonesia. All Rights Reserved.
                            <br> Partner
                            with {{$company->company_name}}.<br>
                            Web App Version 1.0.5<br>
                            <!-- <?php $y = date('Y'); ?>
                        &copy; 2018-{{$y}}&nbsp;{{$company->company_id}}. All Rights Reserved.<br>
                        Web Platform | Beta Version 1.0.9 -->
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{!!asset('auth/js/my-login.js')!!}"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function () {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 35,
                        "density": {
                            "enable": true,
                            "value_area": 500
                        }
                    },
                    // Dot color
                    "color": {
                        "value": "#f93a0b"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    // Line color
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ccc",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 100
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true,
                "config_demo": {
                    "hide_card": false,
                    "background_color": "#b61924",
                    "background_image": "",
                    "background_position": "100% 100%",
                    "background_repeat": "no-repeat",
                    "background_size": "cover"
                }
            });

        });

    </script>
</body>

</html>
