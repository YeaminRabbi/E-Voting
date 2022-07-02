@extends('layouts.backend.master')

@section('page_content')
    <div class="container">

        <div class="row mt-3 mb-4">
            <div class="col-md-8">
                <h4>This Poll is Open from <span style="color: lime;"> {{ date('h:ia', strtotime( $portal->start_time))  }}</span> to <span style="color:lime;">{{ date('h:ia', strtotime( $portal->end_time)) }}</span> at <span style="color:lime;">{{ date('d M, Y', strtotime( $portal->date)) }}</span></h4>
            </div>
            <div class="col-md-4">
                <a href="{{ route('portallist-organizer') }}" class="btn btn-dark btn-round px-5">Back</a>
                <a href="{{ route('portalChange-organizer', $portal->id) }}" class="btn btn-success btn-round px-5">Make Changes</a>
            </div>



        </div>
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
@endsection
