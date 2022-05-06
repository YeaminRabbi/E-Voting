@extends('layouts.backend.master')

@section('page_content')
    <div class="container">
      <div class="row mt-3">
      

        <div class="col-md-12">

            <h4 class="mt-2 mb-3">User List</h4>
              <div class="table-responsive">
                <table class="table" id="userTable" style="color:black;background-color:aquamarine;">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Organizer</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if ($users->isNotEmpty())
                        
                        @foreach ($users as $key => $data)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>

                            <td>
                                {{ $data->getOrganizer($data->organizer_id)->name }}
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