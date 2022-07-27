@extends('layouts.backend.userlayout')

@section('page_content')
    
<section>
    <div class="">
        <div class="row mt-3">

            <div class="col-8">
                <div class="row">
                    @if ($candidates->isNotEmpty())
                        @foreach ($candidates as $data)
                            <div class="col-md-4">
                                <div class="card profile-card-2">
                                    <div class="card-img-block">
                                        <img class="img-fluid" src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Candidate Image">
                                    </div>
                                    <div class="card-body pt-2">
                                        <h5 class="card-title">{{ $data->get_organizer($data->organizer_id)->name  }}</h5>
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
            </div>
            <div class="col-4">
                <h1>Live Vote Count</h1>

                @if ($candidates->isNotEmpty())
                    @foreach ($candidates as $data)
                            <div class="row">
                                <div class="col d-flex">
                                   <img src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="candidate img" style="border-radius: 50%; width:50px;height:50px;">
                                   &nbsp;&nbsp;&nbsp;&nbsp;<h5 class="mt-2">{{ $data->name }}</h5>
                                </div>
                            </div>
                            <br>
                    @endforeach
                @endif

                <hr>
                            
                    <h5>Choose your candidate</h5>
                
                    <div class="row">
                            <div class="col">
                                @if ($candidates->isNotEmpty())
                                    @foreach ($candidates as $key => $data)
                                    
                                        <label for="voter-{{ $key }}">
                                            <img onclick=selectCandidate('candidateName-{{ $key }}','voter-{{ $key }}') src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="candidate img" style="border-radius: 50%; width:50px;height:50px;cursor: pointer;">
                                        </label>    
                                        <input type="hidden" value="{{ $data->name }}" id="candidateName-{{ $key }}">
                                        <input type="hidden" name="voteMe" id="voter-{{ $key }}"  value="{{ $data->id }}">

                                    @endforeach
                                @endif

                            </div>

                            

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h3 class="text-center" id="SelectedName"></h3>
                            <form action="" method="POST" id="FORMSUBMIT" style="display: none;">
                                @csrf
                                <input type="hidden" value="" id="getcandidateID">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success" style="margin-left: 40%;" onclick="return confirm('Confirm this candidate!?')">Submit</button>
                                    </div>
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

    function selectCandidate(data,voter)
    {
        var name = document.getElementById(data).value;
        var selectedName = document.getElementById('SelectedName').innerHTML = name;
        var candidateID = document.getElementById(voter).value;
        document.getElementById('getcandidateID').value = candidateID;
        document.getElementById('FORMSUBMIT').style.display = "block";


        
    }

</script>


@endsection