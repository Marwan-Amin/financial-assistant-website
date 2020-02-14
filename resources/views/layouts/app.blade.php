<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Financial assisstant</title>

    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Calender Style links -->
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
    <!-- End of Calender Style Links -->

    <!-- Tab icon -->
    <link rel="shortcut icon" href="{{asset('UI/PurpleAdmin/assets/images/wallet.png')}}" />
    <!--End of tab icon -->

    <!-- Bootstrap CDN link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- End of bootstrap CDN link -->
  
    <link rel="stylesheet" type="text/css" href="{{asset('UI/radio/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('UI/PurpleAdmin/assets/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   

    <!-- Table Style  -->
    <link rel="stylesheet" type="text/css" href="{{asset('UI/TableV1/css/main.css')}}">
    <!-- End of Table style -->
    
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row pt-1 pb-1">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="/">
          <p class="m-0">

          <img src="{{asset('UI/PurpleAdmin/assets/images/wallet.png')}}" alt="logo" />
        <span class="app_name">Moneyger</span>
          </p>
        </a>
          <a class="navbar-brand brand-logo-mini" href="/"><img src="{{asset('UI/PurpleAdmin/assets/images/logo.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item nav-settings d-none d-lg-block" >
           
              <a class="nav-link logout-icon" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="transition:.5s all ease-in-out;width: 20px;overflow: hidden;">
              <i class="mdi mdi-power"></i>&nbsp;&nbsp;
              <span class="logout-icon" >{{ __('Logout') }}</span> 
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
      
      <div class="container-fluid page-body-wrapper">
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
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">@guest
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
                
              </span>
            </li>
          </ul>
        </nav>
        @yield('content')

        </div>
    </div>
   
    <script src="{{asset('UI/PurpleAdmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/misc.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/todolist.js')}}"></script>
    <script src="{{asset('UI/PurpleAdmin/assets/js/file-upload.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  

<script>
      $('#expensesTable').DataTable();
      $('#incomesTable').DataTable();
      $('#eventsTable').DataTable();
      $('#budgetTable').DataTable();
      $('#savingsTable').DataTable();

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

$('.logout-icon').hover(function() {
  $(this).css("width" , '70px')
});
$('.logout-icon').mouseleave(function() {
  $(this).css("width" , '20px')
});
} )
  </script>
</body>
</html> 


