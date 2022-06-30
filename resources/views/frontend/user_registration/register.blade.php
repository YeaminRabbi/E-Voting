<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>JellyFish</title>

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

            
		  <div class="card-title text-uppercase text-center py-3">Sign Up</div>
               
                
		    <form action="{{ route('UserAccountCreate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername" class="sr-only">Name</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputUsername" class="form-control input-shadow" name="name" required placeholder="Enter Name">
                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername" class="sr-only">Email</label>
                    <div class="position-relative has-icon-right">
                        <input type="email" id="exampleInputEmail" class="form-control input-shadow" name="email" required placeholder="Enter Email">
                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone" class="sr-only">Phone</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputPhone" class="form-control input-shadow" name="phone" required placeholder="Enter Phone">
                      
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword" class="sr-only">Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" id="exampleInputPassword" name="password" required class="form-control input-shadow" placeholder="Enter Password">
                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-center">Organizer Name</label>
                        <select id="OrganizerList"  name="organizer_id" required>
                            <option ></option>
                            @if ($organizers->isNotEmpty())
                                @foreach ($organizers as $data)
                                    <option class="form-control input-shadow" value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            @endif
                        </select>
                </div>

                
                <button type="submit" class="btn btn-light btn-block">Sign Up</button>
              
			 
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">You have an account? <a href="{{ route('adminlogin') }}"> Sign In here</a></p>
		  </div>
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

  
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
  <script>
      new TomSelect("#OrganizerList",{
          create: false,
          sortField: {
              field: "text",
              direction: "asc"
          }
      });
  </script>
  
</body>
</html>
