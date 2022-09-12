@extends('layouts.backend.master')

@section('page_content')

<section>
    <div class="">
        <div class="row mt-3">

            <div class="col-8">
                <div class="row">
                    <div class="col">
                        <h2>Congratulations to {{ $winnerCandidate->name ?? 'None' }}!</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card profile-card-2">
                            <div class="card-img-block">
                                <img class="img-fluid"
                                    src="{{ asset('images/candidate/'.$winnerCandidate->created_at->format('Y/M/').'/'.$winnerCandidate->image) }}"
                                    alt="Candidate Image">
                            </div>
                            <div class="card-body pt-2">
                                <h5 class="card-title">
                                    {{ $winnerCandidate->get_organizer($winnerCandidate->organizer_id)->name ?? 'None'  }}
                                </h5>
                            </div>

                            <div class="card-body border-top border-light">
                                <div class="media align-items-center">
                                    <div class="media-body text-left ml-3">
                                        <p> Name: {{ $winnerCandidate->name }} </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="media align-items-center">
                                    <div class="media-body text-left ml-3">
                                        <p> Designation: {{ $winnerCandidate->designation }} </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="media align-items-center">
                                    <div class="media-body text-left ml-3">
                                        <p> Email: {{ $winnerCandidate->email }} </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="media align-items-center">
                                    <div class="media-body text-left ml-3">
                                        <p> Phone: {{ $winnerCandidate->phone }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <h3>Candidate with vote Counts</h3>

                @if ($candidates->isNotEmpty())
                    @foreach ($candidates as $data)
                    <div class="row">
                        <div class="col d-flex">
                            <img src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}"
                                alt="candidate img" style="border-radius: 50%; width:50px;height:50px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;<h5 class="mt-2">{{ $data->name }}</h5>


                        </div>
                        <div class="col">
                            <p style="margin-left:30%;font-size:25px;">{{ $data->get_voteCount($data->id) }}</p>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif


            </div>



        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('portallist') }}" class="btn btn-block btn-dark">Back</a>
            </div>
        </div>

    </div>
</section>

@endsection
