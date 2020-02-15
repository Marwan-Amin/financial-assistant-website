<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Moneyger - Home</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link
            rel="shortcut icon"
            href="{{asset('UI/PurpleAdmin/assets/images/wallet.png')}}"/>
        <link
            href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,700,800"
            rel="stylesheet">

        <link
            rel="stylesheet"
            href="{{asset('UI/homePage/css/open-iconic-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('UI/homePage/css/animate.css')}}">

        <link rel="stylesheet" href="{{asset('UI/homePage/css/owl.carousel.min.css')}}">
        <link
            rel="stylesheet"
            href="{{asset('UI/homePage/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('UI/homePage/css/magnific-popup.css')}}">

        <link rel="stylesheet" href="{{asset('UI/homePage/css/aos.css')}}">

        <link rel="stylesheet" href="{{asset('UI/homePage/css/ionicons.min.css')}}">

        <link
            rel="stylesheet"
            href="{{asset('UI/homePage/css/bootstrap-datepicker.css')}}">
        <link
            rel="stylesheet"
            href="{{asset('UI/homePage/css/jquery.timepicker.css')}}">

        <link rel="stylesheet" href="{{asset('UI/homePage/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('UI/homePage/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{asset('UI/homePage/css/style.css')}}">


        
        
    </head>
    <body>

        <nav
            class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
            id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="/">Moneyger</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#ftco-nav"
                    aria-controls="ftco-nav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span>
                    Menu
                </button>

                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" data-scroll class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" data-scroll class="nav-link">Features</a>
                        </li>
                        <li class="nav-item">
                            <a href="#testemonials" data-scroll class="nav-link">Testemonials</a>
                        </li>
                        <li class="nav-item">
                            <a href="/blogs" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" data-scroll class="nav-link">Contact</a>
                        </li>
                        @guest
                        <li>
                            <a href="{{route('register')}}" class="btn btn-primary btn-outline-white px-4 py-3">Register</a>
                        </li>
                        <li>
                            <a href="{{route('login')}}" class="btn btn-primary btn-outline-white mx-3 px-4 py-3">Log in</a>
                        </li>
                        @else
                        <li class="nav-item">
                        <a href="/userHome" class="nav-link">My dashboard</a>
                        </li>
                        <li class="nav-item ">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }} 
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       
        @yield('content')
        <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Application</h2>
              <p>We bring together all of your income, bills and more, so you can conveniently manage your finances from one dashboard,.</p>
              
            </div>
          </div>
         
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Contact Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">1 Mahmoud Said St., Shohada Square, Main Post Office Building, Alexandria</a></li>
                <li><a href="#" class="py-2 d-block">+ 033906924/5/6</a></li>
                <li><a href="#" class="py-2 d-block"> ITIinfo@iti.gov.eg</a></li>
                
              </ul>
            </div>
          </div>

          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Follow us</h2>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                <li><a href="https://twitter.com/itichannel2"><span class="icon-twitter"></span></a></li>
                <li><a href="https://www.facebook.com/Ask.iTi.gov"><span class="icon-facebook"></span></a></li>
                <li><a href="https://www.linkedin.com/company/294614"><span class="icon-linkedin"></span></a></li>
              </ul>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p> Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
          </div>
        </div>
      </div>
    </footer>

        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="48px" height="48px"><circle
                class="path-bg"
                cx="24"
                cy="24"
                r="22"
                fill="none"
                stroke-width="4"
                stroke="#eeeeee"/><circle
                class="path"
                cx="24"
                cy="24"
                r="22"
                fill="none"
                stroke-width="4"
                stroke-miterlimit="10"
                stroke="#F96D00"/></svg>
        </div>
        <script src="{{asset('UI/homePage/js/jquery.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.0/smooth-scroll.min.js"></script>
        <script>
            $( function(){
                smoothScroll.init();
            } );
        </script>
        <script src="{{asset('UI/homePage/js/jquery-migrate-3.0.1.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/popper.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.easing.1.3.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.stellar.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/aos.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.animateNumber.min.js')}}"></script>
        <script src="{{asset('UI/homePage/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.timepicker.min.js')}}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="{{asset('UI/homePage/js/google-map.js')}}"></script>
        <script src="{{asset('UI/homePage/js/main.js')}}"></script>

    </body>
</html>