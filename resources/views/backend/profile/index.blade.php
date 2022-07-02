@extends('layouts.backend.master')

@section('page_content')
   <section id="ProfileContent">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    @if (\Session::has('success'))
                            <div class="alert alert-success" id="ALERT">
                                {!! \Session::get('success') !!}
                            </div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                <div class="card-title">My Profile</div>
                <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-rounded" value="{{ $user->name }}" name="name" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-rounded" value="{{ $user->email }}" name="email" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control form-control-rounded" value="{{ $user->phone }}" name="phone" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control form-control-rounded" value="*******" name="password" disabled>
                            </div>
                        </div>

                    </div>



                    <div class="form-group">
                        <a onclick="Show('UpdateProfileContent' , 'ProfileContent')" class="btn btn-warning btn-round px-5 mt-3">Make Changes</a>

                    </div>

                </div>
                </div>
            </div>



            </div><!--End Row-->


        </div>
   </section>

    <section id="UpdateProfileContent" style="display: none;">
        <div class="container">
            <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                <div class="card-title">My Profile</div>
                <hr>
                    <form action="{{ route('UpdateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-rounded" value="{{ $user->name }}" name="name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-rounded" value="{{ $user->email }}" name="email" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control form-control-rounded" value="{{ $user->phone }}" name="phone" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password </label>  <strong style="color: lime;"> - Optional(Input to make password change)</strong>
                                <input type="password" class="form-control form-control-rounded"  name="password" >
                            </div>
                        </div>

                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-round px-5 mt-3">Save Changes</button>
                        <a onclick="Show('ProfileContent','UpdateProfileContent')" class="btn btn-dark btn-round px-5 mt-3">Back</a>

                    </div>
                </form>
                </div>
                </div>
            </div>



            </div>
        </div>
    </section>
@endsection

@section('footer_js')

<script>
    function Show(d1,d2){
        var x = document.getElementById(d1);
        var y = document.getElementById(d2);

        if (x.style.display === "block") {
          x.style.display = "none";
          y.style.display = "block";

        } else {
          x.style.display = "block";
          y.style.display = "none";

        }
    }
</script>
@endsection
