<div class="row">
  <div class="col-md-5 offset-1 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="">
          <div class="card-header">
            <h5 class="text-center">Import Emails</h5>
          </div>
              <a href="{{route('project-download-email')}}" class=" mb-3 float-right">Download Sample</a>
        </div>
        <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="email">
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="form-group">
            <label for="exampleInputUsername1">Select File</label>
            <input type="file" class="form-control file-upload-browse btn btn-primary" id="exampleInputUsername1"  name="email_file">
            @error('email_file')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-success mr-2">Import</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-5  grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="">
          <div class="card-header">
            <h5 class="text-center">Import Address</h5>
          </div>
              <a href="{{route('project-download-address')}}" class="mb-3 float-right">Download Sample</a>
        </div>
        <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="address">
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="form-group">
            <label for="exampleInputUsername1">Select File</label>
            <input type="file" class="form-control file-upload-browse btn btn-primary" id="exampleInputUsername1"  name="address_file">
            @error('address_file')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-success mr-2">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>
