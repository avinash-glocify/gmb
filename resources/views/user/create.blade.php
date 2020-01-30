@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Add User</h2>
          <form class="forms-sample" method="post" action="{{ route('store-user') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">First Name</label>
              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername1" value="{{ old('first_name') }}"  name="first_name" placeholder="First Name">
              @error('first_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Last Name</label>
              <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputUsername2" value="{{ old('last_name') }}" name="last_name" placeholder="Last Name">
              @error('last_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('email') }}" name="email" placeholder="Email">
              @error('email')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" value="{{ old('password') }}" name="password" placeholder="Password">
              @error('password')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputConfirmPassword1">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-success mr-2">
                {{ __('Register') }}
            </button>
              <a  href="{{ route('users-list') }}"class="btn btn-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
