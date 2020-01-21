@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <p class="card-title mb-3">Import Projects</p>
            </div>
            <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Project Name</label>
                <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="exampleInputUsername1" value="{{ old('project_name') }}"  name="project_name" placeholder="Project Name">
                @error('project_name')
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
