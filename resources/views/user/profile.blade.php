@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center">User Profile</h4>
          <form class="forms-sample" method="post" action="{{ route('update-profile') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">First Name</label>
              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername1" value="{{ old('first_name', $user->first_name) }}"  name="first_name" placeholder="First Name">
              @error('first_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Last Name</label>
              <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputUsername2" value="{{ old('last_name', $user->last_name) }}" name="last_name" placeholder="Last Name">
              @error('last_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('email', $user->email) }}" name="email" placeholder="Email">
              @error('email')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" value="" name="password" placeholder="Password">
              @error('password')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputConfirmPassword1">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="password_confirmation" value="" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
