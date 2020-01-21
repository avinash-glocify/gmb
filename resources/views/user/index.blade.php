@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <p class="card-title mb-3">Users</p>
                  <a href="{{route('create-user')}}" class="btn btn-primary mb-3">Create</a>
            </div>
            @if(Session::has('success'))
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <div class="alert alert-success col-md-12 text-center">
                  {{ Session::get('success')}}
                </div>
              </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $key => $user)
                      <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
