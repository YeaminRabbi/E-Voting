@extends('layouts.backend.userlayout')

@section('page_content')
    
<section>
    <div class="">
        <div class="row mt-3">

            <div class="col-8">
                <div class="row">
                    @if ($candidates->isNotEmpty())
                        @foreach ($candidates as $data)
                            <div class="col-md-3">
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
               
            </div>
            
       </div>

       <div class="row">
        <div class="col-12">

        </div>
       </div>

    </div>
</section>
	
@endsection