@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2  grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center">Add Bussiness Type</h4>
          <form class="forms-sample" method="post" action="{{ route('bussiness.store') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Bussiness Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="projectName" value="{{ old('name')  }}"  name="name" placeholder="Bussiness Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-success mr-2">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
