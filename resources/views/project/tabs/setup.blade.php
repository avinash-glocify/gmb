<div class="row">
  <div class="col-md-5 offset-1 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Import Emails</h4>
        <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="mail">
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
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-5  grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Import Address</h4>
        <form class="forms-sample" method="post" action="{{ route('store-project') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="address">
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
        </form>
      </div>
    </div>
  </div>
</div>
