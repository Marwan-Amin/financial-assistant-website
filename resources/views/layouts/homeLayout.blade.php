<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Financial Assistant</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link
            rel="shortcut icon"
            href="{{asset('UI/PurpleAdmin/assets/images/favicon.png')}}"/>
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
                <a class="navbar-brand" href="/">Financial Assisstant</a>
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
                            <a href="#about" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" class="nav-link">Features</a>
                        </li>
                        <li class="nav-item">
                            <a href="/testemonials" class="nav-link">Testemonials</a>
                        </li>
                        <li class="nav-item">
                            <a href="/blogs" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contact" class="nav-link">Contact</a>
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
        <div id="app">
            @yield('content')

        </div>

        <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Company</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Home</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Portfolio</a></li>
                <li><a href="#" class="py-2 d-block">Contact</a></li>
                <li><a href="#" class="py-2 d-block">Privacy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Contact Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">198 West 21th Street, Suite 721 New York NY 10016</a></li>
                <li><a href="#" class="py-2 d-block">+ 1235 2355 98</a></li>
                <li><a href="#" class="py-2 d-block">info@yoursite.com</a></li>
                <li><a href="#" class="py-2 d-block">email@email.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries.</p>
              <form action="#" class="subscribe-form">
                <div class="form-group">
                  <span class="icon icon-paper-plane"></span>
                  <input type="text" class="form-control" placeholder="Subscribe">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
   <!-- | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
    <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('UI/homePage/js/jquery.min.js')}}"></script>
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