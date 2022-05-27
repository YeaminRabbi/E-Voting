@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
             <div class="card-body">
             <div class="card-title">Organizer Form</div>
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
                  <button type="submit" class="btn btn-light btn-round px-5">Upload</button>
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