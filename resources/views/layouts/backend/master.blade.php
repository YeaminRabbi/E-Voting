<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Online Voting</title>


  <!-- loader-->
  <link href="{{ asset('backendAssets/assets/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('backendAssets/assets/js/pace.min.js') }}"></script>
  <!--favicon-->
  <link rel="icon" href="{{ asset('custom_img/f-white.png') }}" type="image/x-icon">

  <!-- Vector CSS -->
  <link href="{{ asset('backendAssets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{ asset('backendAssets/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('backendAssets/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('backendAssets/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('backendAssets/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('backendAssets/assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('backendAssets/assets/css/app-style.css') }}" rel="stylesheet"/>
  <!-- Data Table js -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>

<body class="bg-theme bg-theme1">

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
        <div class="brand-logo">
            <a href="{{ route('dashboard') }}">
            <img src="{{ asset('backendAssets/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">{{ Auth::user()->name }}</h5>
            </a>
        </div>

        @if (Auth::user()->hasRole('admin'))
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header">MAIN NAVIGATION</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                    <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-header">Organizers - Users</li>
                <li>
                    <a href="{{ route('organizer') }}">
                        <i class="zmdi zmdi-group"></i><span>Organizer</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('addUsers') }}">
                        <i class="zmdi zmdi-archive"></i><span>Add User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('userlist') }}">
                        <i class="zmdi zmdi-accounts-alt"></i><span>User-List</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('DuplicateEmailUsers') }}">
                        <i class="zmdi zmdi-accounts-alt"></i><span>Duplicate Emails</span>
                    </a>
                </li>



                <li class="sidebar-header">Voting Portal</li>

                <li>
                    <a href="{{ route('votingportal') }}">
                        <i class="zmdi zmdi-archive"></i><span>Create Portal</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('portallist') }}">
                        <i class="zmdi zmdi-format-list-bulleted"></i><span>Portal List</span>
                    </a>
                </li>

            </ul>
        @elseif(Auth::user()->hasRole('organizer'))
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header">MAIN NAVIGATION</li>
                <li>
                    <a href="{{ route('oraganizer-panel') }}">
                    <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-header">Users</li>


                <li>
                    <a href="{{ route('addUsers-organizer') }}">
                        <i class="zmdi zmdi-archive"></i><span>Add User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('userlist-organizer') }}">
                        <i class="zmdi zmdi-accounts-alt"></i><span>User-List</span>
                    </a>
                </li>



                <li class="sidebar-header">Voting Portal</li>

                <li>
                    <a href="{{ route('votingportal-organizer') }}">
                        <i class="zmdi zmdi-archive"></i><span>Create Portal</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('portallist-organizer') }}">
                        <i class="zmdi zmdi-format-list-bulleted"></i><span>Portal List</span>
                    </a>
                </li>

            </ul>
        @endif


   </div>
   <!--End sidebar-wrapper-->


<!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                <i class="icon-menu menu-icon"></i>
                </a>
                </li>

            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{ asset('custom_img/2.jpg') }}" class="img-circle" alt="user avatar"></span> <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3" src="{{ asset('custom_img/2.jpg') }}" alt="user avatar"></div>
                                <div class="media-body">
                                <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
                                <p class="user-subtitle">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            </a>
                        </li>



                        <li class="dropdown-item">
                            <div onclick="window.location='{{ route("myAccount") }}'" style="cursor: pointer;">
                                <i class="icon-wallet mr-2"></i> Profile
                            </div>
                        </li>





                        <li class="dropdown-divider"></li>


                        <li class="dropdown-item">
                            <div onclick="window.location='{{ route("adminlogout") }}'" style="cursor: pointer;">
                                <i class="icon-power mr-2"></i> Logout
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
<!--End topbar header-->

<div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">

        <!--Start Dashboard Content-->

        @yield('page_content')

        <!--End Dashboard Content-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->

    </div><!--End content-wrapper-->

   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
            <p>Copyright © <?php $year = date("Y"); echo $year; ?> All rights reserved. Developed by <a href="#" target="_blank">DEVELOP IT</a></p>
        </div>
      </div>
    </footer>
	<!--End footer-->


  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backendAssets/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backendAssets/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('backendAssets/assets/js/bootstrap.min.js') }}"></script>




 <!-- simplebar js -->
  <script src="{{ asset('backendAssets/assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('backendAssets/assets/js/sidebar-menu.js') }}"></script>
  <!-- loader scripts -->
  <script src="{{ asset('backendAssets/assets/js/jquery.loading-indicator.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('backendAssets/assets/js/app-script.js') }}"></script>
  <!-- Chart js -->

  <script src="{{ asset('backendAssets/assets/plugins/Chart.js/Chart.min.js') }}"></script>

  <!-- Index js -->
  <script src="{{ asset('backendAssets/assets/js/index.js') }}"></script>

  @yield('footer_js')


</body>
</html>
