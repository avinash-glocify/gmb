@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Formula Detail</h2>
            <form class="forms-sample" method="post"  action="{{ route('formulas.store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Formula Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}"  name="name" placeholder="Formula Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}" name="description" placeholder="Formula Description" rows="4"></textarea>
              @error('description')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Select File</label>
              <input type="file" class="form-control file-upload-browse btn btn-primary"  name="file">
              @error('file')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Link</label>
              <input type="text" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" name="link" placeholder="Paste Video Link Here">
              @error('link')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
             <div class="mt-2">
                <button type="submit" class="btn btn-success mr-2">
                  Save
                </button>
                <a  href="{{ route('formulas.index') }}"class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
