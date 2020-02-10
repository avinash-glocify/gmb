<div class="modal fade" id="fileUploadModal">
  <div class="modal-dialog modal-lg col-md-8">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Attach Files To Task</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <form class="forms-sample" method="post"  action="{{ route('todo.fileupload', [$todo->id]) }}" enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Select File</label>
              <input type="file" class="form-control file-upload-browse btn btn-primary"  multiple name="files[]">
              @error('files')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success mr-2">Upload</button>
            <a  href="javascript:void(0);" data-dismiss="modal" class="btn btn-danger">Cancel</a>
          </div>
        </form>

    </div>
  </div>
</div>
