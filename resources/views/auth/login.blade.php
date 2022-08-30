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
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('backendAssets/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('backendAssets/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('backendAssets/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('backendAssets/assets/css/app-style.css') }}" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="{{ asset('backendAssets/assets/images/logo-icon.png') }}" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
      @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show p-2" role="alert">
              <strong> {!! \Session::get('success') !!}</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif
          
		    <form action="{{ route('adminlogin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername" class="sr-only">Email</label>
                    <div class="position-relative has-icon-right">
                        <input type="email" id="exampleInputEmail" class="form-control input-shadow" name="email" placeholder="Enter Email">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword" class="sr-only">Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" id="exampleInputPassword" name="password" class="form-control input-shadow" placeholder="Enter Password">
                        <div class="form-control-position">
                            <i class="icon-lock"></i>
                        </div>
                    </div>
                </div>
               
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
                <button type="submit" class="btn btn-light btn-block">Sign In</button>
                
             
			 </form>
		   </div>
		  </div>
		  {{-- <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">Do not have an account? <a href="{{ route('user_registration') }}"> Sign Up here</a></p>
		  </div> --}}
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	

	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backendAssets/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backendAssets/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('backendAssets/assets/js/bootstrap.min.js') }}"></script>
	
  <!-- sidebar-menu js -->
  <script src="{{ asset('backendAssets/assets/js/sidebar-menu.js') }}"></script>
  
  <!-- Custom scripts -->
  <script src="{{ asset('backendAssets/assets/js/app-script.js') }}"></script>
  
</body>
</html>
