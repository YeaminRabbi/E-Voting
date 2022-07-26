@extends('layouts.backend.userlayout')

@section('page_content')
    
<section>
    <div class="">
        <div class="row mt-3">

            @if ($candidates->isNotEmpty())
               @foreach ($candidates as $data)
                   <div class="col-lg-4">
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
</section>
	
@endsection