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
                      <th scope="col">Organizer</th>
                      <th scope="col">Position</th>
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
                            <td>{{ $data->get_organizer($data->organizer_id)->name }}</td>
                            <td>{{ $data->position }}</td>
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
                                  <a href="{{ route('portalActive', $data->id) }}" class="btn btn-dark btn-sm">Make Active</a>
                                  <a href="{{ route('portalChange', $data->id) }}" class="btn btn-primary btn-sm">Change</a>
                                  <a href="{{ route('portalView', $data->id) }}" class="btn btn-warning btn-sm">View</a>

                               @elseif ($data->status == 1)
                                  <a href="{{ route('portalClose', $data->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure? You want to Close the Portal!')">Close Portal</a>

                               @elseif($data->status == 2)
                                  <a href="{{ route('AdminResultHistory', $data->id) }}">
                                    <button class="btn btn-success btn-sm">Results</button>
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

      </div><!--End Row-->

    </div>


@endsection


@section('footer_js')
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"/>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#userTable').DataTable();
    } );


</script>

@endsection
