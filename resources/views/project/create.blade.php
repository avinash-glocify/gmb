@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Create Project</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 offset-2  grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Project</h4>
          <form class="forms-sample" method="post" action="{{ route('create-project-name') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Project Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="projectName" value="{{ old('name')  }}"  name="name" placeholder="Project Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-success mr-2">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
