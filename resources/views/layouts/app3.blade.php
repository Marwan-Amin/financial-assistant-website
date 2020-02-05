<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Financial assisstant</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->

  <!--start add calender links-->
<link href="{{asset('UI/fullcalendar-4.3.1/packages/core/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/daygrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/timegrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('UI/fullcalendar-4.3.1/packages/list/main.css')}}" rel='stylesheet' />
<script src="{{asset('UI/fullcalendar-4.3.1/packages/core/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/interaction/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/daygrid/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/timegrid/main.js')}}"></script>
<script src="{{asset('UI/fullcalendar-4.3.1/packages/list/main.js')}}"></script>

<style>

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
  <!--end add calender links-->

    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="{{asset('UI/radio/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('UI/PurpleAdmin/assets/images/favicon.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row pt-1 pb-1">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="/">
          <p class="m-0">

          <img src="{{asset('UI/PurpleAdmin/assets/images/logo.png')}}" alt="logo" />
        <span class="app_name">Expense Tracker</span>
          </p>
        </a>
          <a class="navbar-brand brand-logo-mini" href="/"><img src="{{asset('UI/PurpleAdmin/assets/images/logo.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!-- <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div> -->
          <ul class="navbar-nav navbar-nav-right">
            <!-- <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="/user_profile" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                @if ( Auth::user()->avatar)
                  <img src="{{asset(Auth::user()->avatar)}}" alt="image">
                  @else
                  <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" alt="image">
                  @endif
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">@guest
                    Guest
                  @else
                  {{ Auth::user()->name }}
                  @endguest</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> {{ __('Logout') }} </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              </div>
            </li> -->
            <!-- <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('UI/PurpleAdmin/assets/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('UI/PurpleAdmin/assets/images/faces/face2.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('UI/PurpleAdmin/assets/images/faces/face3.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </li> -->
            <li class="nav-item nav-settings d-none d-lg-block">
           
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-power"></i>&nbsp;&nbsp;
              {{ __('Logout') }}
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              </a>
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
                  <img src="{{asset(Auth::user()->avatar)}}" alt="profile">
                  @else
                  <img src="https://www.shareicon.net/data/2016/05/24/770117_people_512x512.png" alt="profile">
                  @endif
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">@guest
                    Guest
                  @else
                  {{ Auth::user()->name }}
                  @endguest</span>
                  <!-- <span class="text-secondary text-small">Project Manager</span> -->
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
                <span class="menu-title">income</span>
                <i class="mdi mdi-square-inc-cash menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/expenses/index">
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
              <a class="nav-link" href="/reports/index">
                <span class="menu-title">Reports</span>
                <i class="mdi mdi-file-outline menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/charts">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/targets/create">
                <span class="menu-title">Budget Goals</span>
                <i class="mdi mdi-run-fast menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/calendar">
                <span class="menu-title">Calendar</span>
                <i class="mdi mdi-calendar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/events/create">
                <span class="menu-title">Create Event</span>
                <i class="mdi mdi-cake-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/events/manager">
                  <span class="menu-title">Event Manager</span>
                  <i class="mdi mdi-calendar-check menu-icon"></i>
                </a>
            </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/prediction">
                  <span class="menu-title">Predict data</span>
                  <i class="mdi  mdi-arrow-up-bold menu-icon"></i>
                </a>
              </li>
              
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Main Actions</h6>
                </div>
                <a href="/incomes/create" class="btn btn-block btn-lg btn-gradient-danger mt-4">+ Add income</a>
                <a href="/savings/create" class="btn btn-block btn-lg btn-gradient-info mt-4">+ Add Savings</a>
                <a href="{{route('expenses.create')}}" class="btn btn-block btn-lg btn-gradient-success mt-4">+ Add expense</a>
                <!-- <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div> -->
              </span>
            </li>
          </ul>
        </nav>
        @yield('content')

        </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    <script src="{{asset('UI/PurpleAdmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('UI/PurpleAdmin/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('UI/PurpleAdmin/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- <script src="{{asset('UI/PurpleAdmin/assets/js/dashboard.js')}}"></script> -->
    <script src="{{asset('UI/PurpleAdmin/assets/js/todolist.js')}}"></script>
        <script src="{{asset('UI/PurpleAdmin/assets/js/file-upload.js')}}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- End custom js for this page -->
    <!-- Custom js for this page -->
    <!-- <script src="{{asset('UI/PurpleAdmin/assets/js/chart.js')}}"></script> -->
    <!-- End custom js for this page -->
   
    <script>
    $(document).ready( function () {
    $('#expensesTable').DataTable();
    } );
    $(document).ready( function () {
    $('#incomeTable').DataTable();
      } );
    $(document).ready( function () {
    $('#eventsTable').DataTable();
    } );
    $(document).ready( function () {
    $('#subEventsTable').DataTable();
    } );
    
  </script>

<script>
$( function(){
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
} )
</script>
  
  </body>
</html> 


