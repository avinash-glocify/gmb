@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Create Projects</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Project Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" value="{{ old('name') }}"  name="name" placeholder="Project Name">
                @error('name')
                    <span class="invalid-feedback ml-1 mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Select File</label>
                <input type="file" class="form-control file-upload-browse btn btn-primary" id="exampleInputUsername1"  name="file">
                @error('file')
                    <span class="invalid-feedback ml-1 mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-success mr-2">Import</button>
                <a  href="{{ route('project-list') }}"class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
