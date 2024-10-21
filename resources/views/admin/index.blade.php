@extends('layouts.dashboard')

@section('pageheader', 'Dashboard')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">List of users</h5>
            <p>Add datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Admin</th>
{{--                   <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                  <th>Completion</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->admin}}</td>
                            </tr>
                            @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        List of users
                        <a href="{{route('invite_view')}}"    class="btn btn-success float-right ">Invite</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection