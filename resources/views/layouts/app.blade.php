<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Purple Admin</title>
        <!-- plugins:css -->
        <link
            rel="stylesheet"
            href="{{asset('UI/PurpleAdmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link
            rel="stylesheet"
            href="{{asset('UI/PurpleAdmin/assets/vendors/css/vendor.bundle.base.css')}}">
        <link
            rel="stylesheet"
            href="{{asset('UI/PurpleAdmin/assets/css/style.css')}}">
        <link
            rel="stylesheet"
            href="{{asset('UI/PurpleAdmin/assets/images/favicon.png')}}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <!-- <script src="{{ asset('js/app.js') }}" defer="defer"></script> -->

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

        <link
            rel="stylesheet"
            href="{{asset('UI/PurpleAdmin/assets/css/style.css')}}">
        <!-- End layout styles -->
        <link
            rel="shortcut icon"
            href="{{asset('UI/PurpleAdmin/assets/images/favicon.png')}}"/>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="{{asset('UI/radio/flaticon.css')}}">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

        
    </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="../../index.html"><img src=" {{asset('UI/PurpleAdmin/assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="{{asset('UI/PurpleAdmin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                @if ( Auth::user()->avatar)
                  <img src="{{asset(Auth::user()->avatar)}}" alt="image">
                  @else
                  <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" alt="image">
                  @endif
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">
                  @guest
                    Guest
                  @else
                  {{ Auth::user()->name }}
                  @endguest
                  </p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="mdi mdi-logout mr-2 text-primary"></i>  {{ __('Logout') }} </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              </div>
            </li> 
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="/user_profile" class="nav-link">
                <div class="nav-profile-image">
                @if ( Auth::user()->avatar)
                  <img src="{{asset(Auth::user()->avatar)}}" alt="image">
                  @else
                  <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" alt="image">
                  @endif
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"> @guest
                    Guest
                  @else
                  {{ Auth::user()->name }}
                  @endguest</span>
                  <span class="text-secondary text-small"> @guest
                    Guest
                  @else
                  {{ Auth::user()->name }}
                  @endguest</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/userHome">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/incomes">
                <span class="menu-title">Income</span>
                <i class="mdi mdi-square-inc-cash menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/expenses/index ">
                  <span class="menu-title">Expenses</span>
                  <i class="mdi mdi-cash-usd menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/savings/create">
                <span class="menu-title">Savings</span>
                <i class="mdi mdi-key menu-icon"></i>
              </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Reports</span>
                  <i class="mdi mdi-file-outline menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Charts</span>
                  <i class="mdi mdi-chart-pie menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/targets/create">
                  <span class="menu-title">Budget Goals</span>
                  <i class="mdi mdi-run-fast menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Calendar</span>
                  <i class="mdi mdi-calendar menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Events Manager</span>
                  <i class="mdi mdi-cake-variant menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Link Bank Account</span>
                  <i class="mdi mdi-bank menu-icon"></i>
                </a>
            </li> 

            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Balance</h6>
                </div>
                <a href="/incomes/create" class="btn btn-block btn-lg btn-gradient-danger mt-4">+ Add income</a>
                <a href="/savings/create" class="btn btn-block btn-lg btn-gradient-info mt-4">+ Add Savings</a>
                <a href="{{route('expenses.create')}}" class="btn btn-block btn-lg btn-gradient-success mt-4">+ Add expense</a>
                
              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
          @yield('content')
            
          </div>
         
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script
        src="{{asset('UI/PurpleAdmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script
        src="{{asset('UI/PurpleAdmin/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script
        src="{{asset('UI/PurpleAdmin/assets/js/off-canvas.js')}}"></script>
    <script
        src="{{asset('UI/PurpleAdmin/assets/js/hoverable-collapse.js')}}"></script>
    <script
        src="{{asset('UI/PurpleAdmin/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script
        src="{{asset('UI/PurpleAdmin/assets/js/dashboard.js')}}"></script>
    <script
        src="{{asset('UI/PurpleAdmin/assets/js/todolist.js')}}"></script>
        <script
        src="{{asset('UI/PurpleAdmin/assets/js/file-upload.js')}}"></script>
    <!-- End custom js for this page -->

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  
    <script>
    $(document).ready( function () {
      $('#incomeTable').DataTable();
      } );
      $(document).ready( function () {
      $('#expensesTable').DataTable();
      } );
    </script>
  </body>

  

</html>