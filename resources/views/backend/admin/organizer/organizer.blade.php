@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card">
             <div class="card-body">
             <div class="card-title">Organizer Form</div>
             <hr>
              <form action="{{ route('organizercreate') }}" method="POST" >
                @csrf
                <div class="form-group">
                  <label for="input-6">Name</label>
                  <input type="text" class="form-control form-control-rounded" name="name" id="input-6" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                  <label for="input-7">Email</label>
                  <input type="text" class="form-control form-control-rounded" name="email" id="input-7" placeholder="Enter Your Email Address" required>
                </div>
                <div class="form-group">
                  <label for="input-8">Mobile</label>
                  <input type="text" class="form-control form-control-rounded" name="phone" id="input-8" placeholder="Enter Your Mobile Number" required>
                </div>
                <div class="form-group">
                  <label for="input-9">Password</label>
                  <input type="text" class="form-control form-control-rounded" name="password" id="input-9" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                  <label for="input-9">Details</label>
                  <textarea name="details" id="input-9" class="form-control form-control-rounded" cols="60" rows="10"></textarea>
                </div>

                
                <div class="form-group">
                  <button type="submit" class="btn btn-light btn-round px-5">Register</button>
                </div>
            </form>
           </div>
           </div>
        </div>

        <div class="col-md-6">
              <div class="table-responsive">
                <table class="table" id="J-Table">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if ($organizers->isNotEmpty())
                        
                        @foreach ($organizers as $key => $data)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                              <a href="{{ route('organizerdelete', $data->id) }}" class="btn btn-warning btn-sm">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                                                
                    @endif
                   
                    
                  </tbody>
                </table>
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