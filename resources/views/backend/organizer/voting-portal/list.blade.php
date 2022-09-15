@extends('layouts.backend.master')

@section('page_content')
<div class="container">
    <div class="row mt-3">


        <div class="col-md-12">

            <h4 class="mt-2 mb-3">Voting Poll(s)</h4>


            <div class="table-responsive">
                <table class="table" id="userTable" style="color:black;background-color:aquamarine;">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>

                            <th scope="col">Position</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Candidates</th>
                             <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($portals->isNotEmpty())

                        @foreach ($portals as $key => $data)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $data->position }}</td>
                            <td>{{ date('d M, Y', strtotime($data->date)) }}</td>
                            <td class="text-center">{{ $data->get_candidate_count($data->id) }}</td>
                            <td>{{ date('h:i a', strtotime($data->start_time)) }}</td>
                            <td>{{ date('h:i a', strtotime($data->end_time)) }}</td>
                            <td>{{ date('d M, Y', strtotime($data->date)) }}</td>
                            <td>
                                @if ($data->status == 0)
                                <p>Pending</p>

                                @elseif ($data->status == 1)
                                <p>Active</p>
                                @elseif($data->status == 2)
                                <p>Complete</p>
                                @else
                                <p>Error</p>
                                @endif
                            </td>

                            <td>
                                @if ($data->status == 0)
                                <a href="{{ route('portalActive-organizer', $data->id) }}" class="btn btn-dark">Make
                                    Active</a>
                                <a href="{{ route('portalChange-organizer', $data->id) }}"
                                    class="btn btn-primary">Change</a>
                                <a href="{{ route('portalView-organizer', $data->id) }}"
                                    class="btn btn-warning">View</a>

                                @elseif ($data->status == 1)
                                <a href="{{ route('portalClose-organizer', $data->id) }}" class="btn btn-danger"
                                    onclick="return confirm('are you sure? You want to Close the Portal!')">Close
                                    Portal</a>

                                @elseif($data->status == 2)
                                <a href="{{ route('OrganizerResultHistory', $data->id) }}">
                                    <button class="btn btn-success">Results</button>
                                </a>
                                @else
                                <p>Error</p>
                                @endif

                            </td>
                        </tr>
                        @endforeach

                        @endif


                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!--End Row-->

</div>


@endsection


@section('footer_js')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#userTable').DataTable();
    });

</script>


<script>
    const btn = document.getElementById("myBtn");
    myFunction();

    function myFunction() {
        btn.disabled = false;
        setTimeout(() => {
            btn.disabled = true;
            console.log('Button Activated')
        }, 5000)
    }

</script>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("June 15, 2022 22:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);

</script>


@endsection
