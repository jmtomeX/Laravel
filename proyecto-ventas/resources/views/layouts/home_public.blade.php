<!DOCTYPE html>
<html lang="en">

<head>
    <title>Photo Gallery</title>

    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Photo Bum Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!--// Meta tag Keywords -->

    <!-- css files -->
    <link href="public_template/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="public_template/css/fontawesome-all.css" rel="stylesheet">

    <link href="public_template/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- css files -->

    <!--fonts-->
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=PT+Sans+Caption:400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
        <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>

    <!--//fonts-->

</head>

<body>

    <!-- banner -->
    <div id="home" class="w3ls-banner">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">

                <h1>
                    <a class="navbar-brand text-white" href="index.html"><i class="fab mr-2 fa-tripadvisor"></i>Photo
                        bum </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item  mr-1">
                            <a class="nav-link" href="{{ url('/') }}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item  mr-1">
                            <a class="w3ls-btn" href="{{ url('about')}}">about</a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item mr-1">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item mr-1">
                            <a class="w3ls-btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item mr-1">
                            <a class="w3ls-btn" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="w3ls-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest

                        <li>
                            <a href="booking.html" class="w3ls-btn"> Book Shoot </a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- //header -->

        @yield('content');

        <!-- footer -->
        <footer class="py-5">
            <div class="container py-md-3">
                <div class="row footer-grids">
                    <div class="col-lg-4 footer-grid-left mb-lg-0 mb-4">
                        <h2><a href="index.html"><i class="fab mr-2 fa-tripadvisor"></i>Photo bum</a></h2>
                        <p class="mt-3">Duis fringilla velit id ipsum dignissim init elementum. Curabitur fermentum
                            libero acsit amet consectetur. </p>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-grid-middle">
                        <h4>About photo bum</h4>
                        <p>Duis fringilla velit id ipsum dignissim init elementum. Curabitur fermentum libero acsit amet
                            consectetur. Vestibulum non posuere sapien, eget feugiat quam. Sed eget sapien nunc. </p>
                    </div>
                    <div class="col-lg-4 col-md-6 subscribe-grid mt-md-0 mt-4">
                        <h4> Connect & subscribe </h4>
                        <div class="social mb-4 text-center">
                            <ul class="d-flex justify-content-start">
                                <li class="mr-2"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li class="mx-sm-2 mr-2"><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li class="mx-sm-2 mr-2"><a href="#"><span class="fas fa-rss"></span></a></li>
                                <li class="mx-sm-2 mr-2"><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li class="mx-sm-2 mr-2"><a href="#"><span class="fab fa-google-plus"></span></a></li>
                            </ul>
                        </div>
                        <form action="#" method="post">
                            <input class="form-control" type="email" placeholder="Subscribe" name="Subscribe"
                                required="">
                            <button class="btn1">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="copyright mt-5">
                    <p class="text-center">© 2018 Photo Bum. All Rights Reserved | Design by <a
                            href="http://w3layouts.com/"> W3layouts </a></p>
                </div>
            </div>
        </footer>
        <!-- //footer -->

        <!-- js -->
        <script type="text/javascript" src="public_template/js/jquery-2.2.3.min.js"></script>
        <!-- //js -->

        <!-- /Responsive slides js -->
        <script src="public_template/js/responsiveslides.min.js"></script>
        <script>
        // You can also use "$(window).load(function() {"
        $(function() {
            // Slideshow 4
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
        </script>
        <script>
        // You can also use "$(window).load(function() {"
        $(function() {
            // Slideshow 4
            $("#slider3").responsiveSlides({
                auto: true,
                pager: false,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
        </script>
        <!-- Responsive slides js -->

        <!-- middle slider -->
        <script>
        $(window).load(function() {
            $("#flexiselDemo1").flexisel({
                visibleItems: 5,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 414,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    },
                    others: {
                        changePoint: 1080,
                        visibleItems: 4
                    }
                }
            });

        });
        </script>
        <script src="public_template/js/jquery.flexisel.js"></script>
        <!-- //middle slider -->

        <!-- stats -->
        <script src="public_template/js/jquery.waypoints.min.js"></script>
        <script src="public_template/js/jquery.countup.js"></script>
        <script>
        $('.counter').countUp();
        </script>
        <!-- //stats -->

        <script src="public_template/js/SmoothScroll.min.js"></script>
        <!-- start-smoth-scrolling -->
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
        </script>
        <!-- start-smoth-scrolling -->
        <!-- here stars scrolling icon -->
        <script type="text/javascript">
        $(document).ready(function() {
            /*
            	var defaults = {
            	containerID: 'toTop', // fading element id
            	containerHoverID: 'toTopHover', // fading element hover id
            	scrollSpeed: 1200,
            	easingType: 'linear' 
            	};
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
        </script>

        <!-- move to top-js-files -->
        <script type="text/javascript" src="public_template/js/move-top.js"></script>
        <script type="text/javascript" src="public_template/js/easing.js"></script>
        <!-- //move to top-js-files -->

        <script type="text/javascript" src="public_template/js/bootstrap.js"></script><!-- bootstrap js file -->

</body>

</html>