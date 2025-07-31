<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    Iseki Astra - Assembling Tracker
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="{{asset('assets/js/42d5adcbca.js')}}" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="{{asset('assets/css/icon.css')}}" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
  
  @yield('style')

</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="{{ route('home') }}">
        <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-md text-primary">Iseki Astra</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $page === 'home' ? 'active bg-gradient-primary text-white' : 'text-dark' }}" href="{{ route('home') }}">
            <i class="material-symbols-rounded opacity-5">home</i>
            <span class="nav-link-text ms-1 {{ $page === 'home' ? 'text-white' : 'text-primary' }}">Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $page === 'track' ? 'active bg-gradient-primary text-white' : 'text-dark' }}" href="{{ route('track') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1 {{ $page === 'track' ? 'text-white' : 'text-primary' }}">Track</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ $page === 'track2' ? 'active bg-gradient-primary text-white' : 'text-dark' }}" href="{{ route('track2') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1 {{ $page === 'track2' ? 'text-white' : 'text-primary' }}">Track 2</span>
          </a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link {{ $page === 'report' ? 'active bg-gradient-primary text-white' : 'text-dark' }}" href="{{ route('user_report') }}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1 {{ $page === 'report' ? 'text-white' : 'text-primary' }}">Report</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $page === 'profile' ? 'active bg-gradient-primary text-white' : 'text-dark' }}" href="{{ route('user_profile') }}">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1 {{ $page === 'profile' ? 'text-white' : 'text-primary' }}">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('logout') }}">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1 text-primary">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <p class="text-center text-primary">{{ session('Username_User') }}</p>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    @yield('content')
    
    <footer class="footer py-4  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-center">
            <div class="col-12 col-md-6 my-auto">
                <div class="copyright text-center text-sm text-muted text-lg-center">
                © <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span class="text-primary">PT. Iseki Indonesia</span> - Assembling Tracker
                </div>
            </div>
            </div>
        </div>
    </footer>
  </main>

  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/material-dashboard.min.js?v=3.2.0')}}"></script>

  @yield('script')
</body>

</html>