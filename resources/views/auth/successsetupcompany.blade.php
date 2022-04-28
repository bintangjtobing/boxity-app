<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Bintang Tobing">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Boxity - Setup Company - Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{!!asset('auth/css/my-login.css')!!}">
    <link rel="shortcut icon" href="{{$company->icon}}" type="image/png" sizes="64x64">
    <meta name="description" content="{{$company->meta_description}}">
    <meta name="keywords" content="{{$company->meta_keywords}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="my-login-page">
    <section class="h-100">
    <div class="container h-100">
        <div class="row align-items-center h-100 py-5">
        <div class="col-12 mx-auto bg-white card h-100 py-4 align-items-center">
            <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center w-100">
            <div class="col-12 text-center">
                <i class="fa fa-check-circle" aria-hidden="true" style="font-size: 100px; color: #F95B12"></i>
            </div>
            <div class="col-12 text-center">
            <h3 class="fomt-weight-bold my-4">All Sets</h3>
            </div>
            <div class="col-6">
            <h5 class="text-grey text-center">
                    We’ll bring you to login’s page, and of course
                you can start our platform. Enjoy.
            </h5>
            </div>

            </div>

            </div>
            <div> Redirecting you to login’s page in <span id="counter"></span>s</div>
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

        var seconds = 3;
        document.getElementById('counter').innerHTML = seconds
        var el = document.getElementById('counter');

        function redirect() {
            // clearInterval(cancel)
            window.location='/'
        }

        function incrementSeconds() {
            seconds -= 1;
            if(seconds == 0) {
                redirect();
            }
            el.innerText = seconds;
        }

        var cancel = setInterval(incrementSeconds, 1000);

        // if(seconds == 0) {
        //     clearInterval(cancel)
        //     window.location='/'
        // }

        //  let counter = 3
        //  let counterDOM = document.getElementById('counter').innerHTML = counter
        // setInterval(function(){
        //     counter = counter - 1
        //     counterDOM.innerHTML = counter
        // }, 1000);
        // if(counter == 0) {
        //     window.location='/'
        // }
        // //  var timer = setTimeout(function() {
        // //     window.location='/'
        // // }, 3000);
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
