@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
        

        <div class="row">

            <div class="col-md-12">
                <h3>Candidate Profile: {{ $candidate->name }}</h3>
            </div>
                <div class="col-md-4">
                    <div class="card profile-card-2">
                        <div class="card-img-block-2">
                            <img class="img-fluid" src="{{ asset('images/candidate/'.$candidate->created_at->format('Y/M/').'/'.$candidate->image) }}" alt="Candidate Image">
                        </div>
                        <div class="card-body pt-2">
                           <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title mt-2">{{ $candidate->get_organizer($candidate->organizer_id)->name  }}</h5>
                                </div>
                               
                           </div>
                        </div>
            
                        <div class="card-body border-top border-light">
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Name: {{ $candidate->name }}     </p>               
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Designation: {{ $candidate->designation }}     </p>               
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Email: {{ $candidate->email }}     </p>               
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Phone: {{ $candidate->phone }}     </p>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <form action="{{ route('CandidateUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input class="form-control" type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                        <div class="row mt-3" id="CandidateForm">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Candidate Name</label>
                                    <input type="text" class="form-control form-control-rounded" value="{{ $candidate->name }}" name="candidate_name" required>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-rounded" value="{{ $candidate->email }}" name="candidate_email" required>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control form-control-rounded" value="{{ $candidate->phone }}" name="candidate_phone" required>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control form-control-rounded" value="{{ $candidate->designation }}" name="designation" required>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image: <span style="color: lime;font-weight:bold;">(Upload to Change)</span></label>
                                    <input type="file" class="form-control form-control-rounded"  name="img">
                                </div>
                            </div>
        
                        </div>
                        
                        <div class="form-group">
                          <button type="submit" class="btn btn-success btn-round px-5">Save Changes</button>
                          <a href="{{ route('portalChange', $candidate->voting_portal_id) }}"  class="btn btn-dark btn-round px-5">Back</a>
                        </div>
                    </form>
                </div>
           
        </div>

       
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