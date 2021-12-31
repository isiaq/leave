<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/favicon" href="/img/logo.jpg">
    <link href="{{ asset('/css/tailwind.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/alpine.min.js') }}" defer></script>

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="/css/font-face.css" rel="stylesheet" media="all">
    <link href="/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- //vendor CSS-->
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!--DataTables -->
    <link rel="stylesheet" href="/css/dataTables.min.css">

    <!-- Main CSS-->
    <link href="/css/theme.css" rel="stylesheet" media="all">

    <!-- my css -->
    <link rel="stylesheet" href="/css/sickomode.css">

    @yield('header')

</head>

<body class="#">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a href="#">
                            <img src="/img/logo.jpg" style="height: 40px; width: 40px" alt="BUA" />
                        </a>
                        <span>BUA Leave App</span>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">

                        <li class="{{ Request::is('home*') ? 'active' : '' }}">
                            <a href="/home">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="{{ Request::is('leaveform-page*') ? 'active' : '' }}">
                            <a href="/doleave">
                                <i class="fas fa-list-alt"></i>Leaveform</a>
                        </li>
                        <li class="{{ Request::is('users_approved*') ? 'active' : '' }}">
                            <a href="/users_approved">
                                <i class="fas fa-check-circle"></i>Approved Forms</a>
                        </li>
                        <li class="{{ Request::is('users_pending*') ? 'active' : '' }}">
                            <a href="/users_pending">
                                <i class="fas fa-exclamation"></i>Pending Forms</a>
                        </li>
                        <li class="{{ Request::is('user_calendar*') ? 'active' : '' }}">
                            <a href="/user_calendar">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="/img/logo.jpg" style="height: 40px; width: 40px" alt="BUA" />
                </a>
                <span class="ml-4">BUA Leave</span>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li class="{{ Request::is('home*') ? 'active' : '' }}">
                            <a href="/home">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="{{ Request::is('doleave*') ? 'active' : '' }}">
                            <a href="/doleave">
                                <i class="fas fa-list-alt"></i>Leaveform</a>
                        </li>
                        <li class="{{ Request::is('users_approved*') ? 'active' : '' }}">
                            <a href="/users_approved">
                                <i class="fas fa-check-circle"></i>Approved Forms</a>
                        </li>
                        <li class="{{ Request::is('users_pending*') ? 'active' : '' }}">
                            <a href="/users_pending">
                                <i class="fas fa-exclamation"></i>Pending Forms</a>
                        </li>
                        <li class="{{ Request::is('user_calendar*') ? 'active' : '' }}">
                            <a href="/user_calendar">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="au-input au-input--xl" style="visibility: hidden;"></div>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="/uploads/avatars/{{ auth()->user()->avatar }}" alt="" />
                                        </div>
                                        <div class="content">
                                        <a class="js-acc-btn" href="#">{{ auth()->user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="/uploads/avatars/{{ auth()->user()->avatar }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ auth()->user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{ auth()->user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="/user_profile">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">

                                                <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i
                                                        class="zmdi zmdi-power"></i>
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- END PAGE CONTAINER-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2020 BUA. All rights reserved.</p>
                </div>
            </div>
        </div>

        </div>
    </div>

    <!-- Jquery JS-->
    <script src="/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- /vendor JS       -->
    <script src="/vendor/slick/slick.min.js">
    </script>
    <script src="/vendor/wow/wow.min.js"></script>
    <script src="/vendor/animsition/animsition.min.js"></script>
    <script src="/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="/vendor/select2/select2.min.js"></script>
    <!--DataTables -->
    <script src="/js/dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
        $('#datatable').DataTable();
    } );
    </script>

    <!-- Main JS-->
    <script src="/js/main.js"></script>

    {{-- sweet alert --}}
    @include('sweetalert::alert')

    @yield('scripts')

</body>

</html>
<!-- end document-->
