@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
             <div class="card-body">
             <div class="card-title">Voting Portal Form</div>
             <hr>
              <form action="{{ route('portalupdate-organizer') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <div class="row">
                    <input type="hidden" name="organizer_id" value="{{ $organizers->id }}">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-7">Date</label>
                            <input type="date" class="form-control form-control-rounded" value="{{ $portal->date }}" name="date" id="input-7" placeholder="Enter Your Email Address" required>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-71">Position</label>
                            <input type="text" class="form-control form-control-rounded"  value="{{ $portal->position }}" name="position" id="input-71" placeholder="Position to Vote" required>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-712">Voting Start</label>
                            <input type="time" class="form-control form-control-rounded"  value="{{ $portal->start_time }}" name="start_time" id="input-712" required>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-7122">Voting End</label>
                            <input type="time" class="form-control form-control-rounded" value="{{ $portal->end_time }}" name="end_time" id="input-7122" required>
                        </div>

                    </div>


                </div>



                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-round px-5">Save Changes</button>
                  <a href="{{ route('portallist-organizer') }}" class="btn btn-dark btn-round px-5">Back</a>
                </div>
            </form>
           </div>
           </div>
        </div>



      </div><!--End Row-->

      <hr>

      <div class="row mt-5" id="CandidateShow">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-3">Candidates:</h3>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success btn-round px-5" onclick="show('CandidateAddForm','CandidateShow')">Add New Candidate</button>
                </div>
            </div>
        </div>
        @if ($candidates->isNotEmpty())
            @foreach ($candidates as $data)
                <div class="col-lg-4">
                    <div class="card profile-card-2">
                        <div class="card-img-block">
                            <img class="img-fluid" src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Candidate Image">
                        </div>
                        <div class="card-body pt-2">
                           <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title mt-2">{{ $data->get_organizer($data->organizer_id)->name  }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('CandidateChange-organizer', $data->id) }}" class="btn btn-warning btn-round px-5" >Edit</a>

                                </div>
                           </div>
                        </div>

                        <div class="card-body border-top border-light">
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Name: {{ $data->name }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Designation: {{ $data->designation }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Email: {{ $data->email }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-left ml-3">
                                <p> Phone: {{ $data->phone }}     </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
      </div>

      <div class="row mt-5" id="CandidateAddForm" style="display: none;">
        <div class="col-md-6">
            <h4>Add new Candidate</h4>
        </div>
        <form action="{{ route('candidateAddNew-organizer') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="organizer_id" value="{{ $portal->organizer_id  }}">
            <input type="hidden" name="voting_portal_id" value="{{ $portal->id  }}">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Candidate Name</label>
                    <input type="text" class="form-control form-control-rounded" name="candidate_name" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control form-control-rounded" name="candidate_email" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control form-control-rounded" name="candidate_phone" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control form-control-rounded" name="designation" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control form-control-rounded" name="img" required>
                </div>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-round px-5">
                    Add Candidate
                </button>
                <a class="btn btn-round px-5 btn-dark" onclick="show('CandidateShow','CandidateAddForm')">Back</a>
            </div>
        </form>
      </div>

      <div class="row mt-5">
        <div class="col-md-12">
            <a href="{{ route('portallist-organizer') }}" class="btn btn-dark btn-round px-5 btn-block">Back</a>
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
    function show(d1,d2){
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
