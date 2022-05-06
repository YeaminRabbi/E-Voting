@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
             <div class="card-body">
             <div class="card-title">Voting Portal Form</div>
             <hr>
              <form action="{{ route('portalcreate') }}" method="POST" >
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-6">Organizer</label>
                            
                            <select id="OrganizerList"  name="organizer_id" required>
                                <option ></option>
                                @if ($organizers->isNotEmpty())
                                    @foreach ($organizers as $data)
                                        <option class="form-control input-shadow" value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-7">Date</label>
                            <input type="date" class="form-control form-control-rounded" name="date" id="input-7" placeholder="Enter Your Email Address" required>
                        </div>
                          
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input-71">Position</label>
                            <input type="text" class="form-control form-control-rounded" name="position" id="input-71" placeholder="Position to Vote" required>
                        </div>
                          
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input-712">Voting Start</label>
                            <input type="time" class="form-control form-control-rounded" name="start_time" id="input-712" required>
                        </div>
                          
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input-7122">Voting End</label>
                            <input type="time" class="form-control form-control-rounded" name="end_time" id="input-7122" required>
                        </div>
                          
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input-3">Details</label>
                            <textarea name="details" id="input-3" class="form-control form-control-rounded" required cols="60" rows="3"></textarea>
                        </div>
                          
                    </div>
                </div>
                
               

                <div class="row">
                    <div class="col-md-6">
                        <div class="card-title mt-4 ">Add Candidate(s)</div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <span id="add" class="btn btn-success add-more button-blue tx-uppercase mr-2" onclick="ADDFORM()" style="cursor:pointer;">ADD</span>
                      
                      
                    </div>

                   
                </div>
                

                <div class="row mt-3" id="CandidateForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Candidate Name</label>
                            <input type="text" class="form-control form-control-rounded" name="candidate_name[]" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-rounded" name="candidate_email[]" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control form-control-rounded" name="candidate_phone[]" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control form-control-rounded" name="designation[]" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control form-control-rounded" name="img[]" required>
                        </div>
                    </div>

                    <hr>

                    <div id="items" class="mt-3">
                        
                    </div>
                </div>
                
                <div class="form-group">
                  <button type="submit" class="btn btn-light btn-round px-5">Submit</button>
                </div>
            </form>
           </div>
           </div>
        </div>

     
      
      </div><!--End Row-->
  
    </div>
@endsection

@section('footer_js')
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

<script>
    function ADDFORM(){

        console.log('hekko');
        var form = document.getElementById('items');
       
        form.innerHTML+= 
        '<hr>'+
        '<div class="row">'+
           
            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label>Name</label>'+
                    '<input type="text" class="form-control form-control-rounded" name="candidate_name[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label>Email</label>'+
                    '<input type="text" class="form-control form-control-rounded" name="candidate_email[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-4">'+
                '<div class="form-group">'+
                    '<label>Phone</label>'+
                    '<input type="text" class="form-control form-control-rounded" name="candidate_phone[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-4">'+
                '<div class="form-group">'+
                    '<label>Designation</label>'+
                    '<input type="text" class="form-control form-control-rounded" name="designation[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-4">'+
                '<div class="form-group">'+
                    '<label>Image</label>'+
                    '<input type="file" class="form-control form-control-rounded" name="img[]" required>'+
                '</div>'+
            '</div>'+
        '</div>'+
       '<br>';
    }
</script>
@endsection