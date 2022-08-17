@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-12">
            @if (\Session::has('success'))
                    <div class="alert alert-success" id="ALERT">
                        {!! \Session::get('success') !!}
                    </div>
            @endif
        </div>
        <div class="col-mb-12">
            <p class="ml-2">Click make changes to <span style="color:lime;font-weight:bold;">"CHANGE TO CURRENT ORGANIZER"</span></p>
        </div>

        <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <h4 class="mt-2 mb-3">Duplicate Email List</h4>

                </div>
                <div class="col-md-6">

                  @if ($duplicateEmails->isNotEmpty())
                      <a href="{{ route('AllUserUpdateOrganizer') }}" class="btn btn-warning btn-md float-right">Make Changes to All Users</a>
                    
                  @else
                      <a href="" class="btn btn-warning btn-md float-right disabled">Make Changes to All Users</a>
                    
                  @endif
                </div>
              </div>
              <div class="table-responsive">
                <table class="table" id="userTable" style="color:black;background-color:aquamarine;">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Organizer</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if ($duplicateEmails->isNotEmpty())

                        @foreach ($duplicateEmails as $key => $data)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                           
                            <td>
                                {{ $data->getOrganizer($data->organizer_id)->name  ?? ''}}
                            </td>
                            <td>{{ $data->created_at->format('d-M-Y') }}</td>
                            <td>
                                <a href="{{ route('UpdateDubplicateEmails', $data->id) }}" class="btn btn-sm btn-round btn-primary">Make Changes</a>
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

    console.log('asasd');
</script>
@endsection
