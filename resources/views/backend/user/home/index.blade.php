@extends('layouts.backend.userlayout')

@section('page_content')
    
<section>
    <div class="">
        <div class="row">
            @if ($polls->isNotEmpty())
            @foreach ($polls as $data)
                <div class="col-lg-4">
                    <div class="card profile-card-2">
                       
                        <div class="card-body pt-2">
                            <h5 class="card-title text-center">{{ $data->position  }}</h5>
                        </div>

                        <div class="card-body border-top border-light">
                            <div class="media align-items-center">
                                <div class="media-body text-center ml-3">
                                  <p> Date: {{ $data->date }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-center ml-3">
                                  <p> Start: {{ $data->start_time }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-center ml-3">
                                  <p> End: {{ $data->end_time }}     </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <div class="media-body text-center ml-3">
                                 <a href="{{ route('GetToVote', $data->id) }}">
                                    <button class="btn btn-round btn-success">View</button>
                                 </a>
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>

            @endforeach
         @endif
        </div>
    </div>
</section>
	
@endsection