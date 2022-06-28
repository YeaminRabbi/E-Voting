@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">

        <div class="col-md-12">

            @if (\Session::has('duplicateEmail'))
                    <div class="alert alert-warning" id="ALERT">
                       <span>Few email are found to be prexisted in the System!</span>

                        <a href="{{ route('DuplicateEmailUsers') }}" style="color:blue;font-weight:bold;">&nbsp;&nbsp; Click for more details..</a>
                    </div>
            @endif

            @if (\Session::has('success'))
                    <div class="alert alert-success" id="ALERT">
                        {!! \Session::get('success') !!}
                    </div>
            @endif
        </div>

        <div class="col-md-12">
            <div class="card">
               <div class="card-body">
               <div class="card-title">Add Single User</div>
               <hr>
                <form action="{{ route('addSingleUser') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="input-6">Name</label>
                                <input type="text" class="form-control form-control-rounded" name="name" id="input-6" placeholder="Enter Your Name" required>
                                </div>
                        </div>

                        <div class="col-6">
                                <div class="form-group">
                                    <label for="input-6">Email</label>
                                    <input type="text" class="form-control form-control-rounded" name="email" id="input-6" placeholder="Enter Your Name" required>
                                </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="input-6">Phone</label>
                                <input type="text" class="form-control form-control-rounded" name="phone" id="input-6" placeholder="Enter Your Name" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <label> Organizations:</label>

                            <select id="organizer" class="form-control form-control-rounded" name="organizer_id">
                                <option selected>--Select One--</option>

                                @foreach ($organizers as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>

                        </div>

                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-light btn-round px-5">Add User</button>
                  </div>
              </form>
             </div>
             </div>
        </div>

        <div class="col-md-12">
          <div class="card">
             <div class="card-body">
             <div class="card-title">Add Multiple Users</div>
             <hr>
              <form action="{{ route('userlistUpload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-6">
                        <label> Organizations:</label>

                        <select id="organizer" class="form-control form-control-rounded" name="organizer_id">
                            <option selected>--Select One--</option>

                            @foreach ($organizers as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="input-6">Upload the User list in Excel format</label>
                            <input type="file" class="form-control form-control-rounded" name="uploaded_file" id="input-6" placeholder="Enter Your Name" required>
                          </div>
                    </div>


                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-light btn-round px-5">Import Users</button>
                </div>
            </form>
           </div>
           </div>
        </div>



      </div><!--End Row-->

    </div>
@endsection


@section('footer_js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#J-Table').DataTable();
    });
</script>
@endsection
