<div class="row">
  <div class="col-md-5 offset-1 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="">
          @if(Session::has('success_email_import'))
            <p class="alert-success p-3">{{ Session::get('success_email_import') }}</p>
          @endif
          <div class="card-header">
            <h5 class="text-center">Emails</h5>
          </div>
          <div class="card-header mb-2">
            <h5><span class="text-success"><strong> {{ $projectWithEmail->count() }} </strong></span><strong> Total</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=""> <strong>{{ $projectWithNumbersCount }}</strong></span><strong> USED</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"> <strong>{{ $projectWithoutNumbersCount }}</strong></span><strong> UNUSED</strong></h5>
          </div>
              <a href="{{route('project-download-email')}}" class=" mb-3 float-right">Download Sample</a>
        </div>
        <form class="forms-sample" method="post" action="{{ route('store-project-emails') }}" enctype="multipart/form-data">
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
      @if(Session::has('error_mail'))
        <div class="card-footer">
          <p> <span>Success. <strong class="text-success">{{ Session::get('newEntry') }} </strong> emails were imported.</span> <span>We found <strong>{{ Session::get('count') }}</strong> duplicate emails. Click <a href="{{ Session::get('error_mail') }}"><strong class="text-danger">download</strong></a> to download duplicate emails.</span></p>
        </div>
      @endif
    </div>
  </div>
  <div class="col-md-5  grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="">
          @if(Session::has('success_address_import'))
            <p class="alert-success p-3">{{ Session::get('success_address_import') }}</p>
          @endif
          <div class="card-header">
            <h5 class="text-center">Addresses and Phone Numbers</h5>
          </div>
          <div class="card-header mb-2">
            <h5><span class="text-success"><strong> {{ $projectWithEmail->count() }} </strong></span><strong> Total</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=""> <strong>{{ $projectWithNumbersCount }}</strong></span><strong> USED</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"> <strong>{{ $projectWithoutNumbersCount }}</strong></span><strong> UNUSED</strong></h5>
          </div>
              <a href="{{route('project-download-address')}}" class="mb-3 float-right">Download Sample</a>
        </div>
        <form class="forms-sample" method="post" action="{{ route('store-project-address') }}" enctype="multipart/form-data">
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
        @if(Session::has('error_address'))
        <div class="card-footer">
            <p><span>Success. <strong class="text-success">{{ Session::get('newEntry') }}</strong> emails were imported.<span> We found {{ Session::get('count') }} duplicate emails. Click <a href="{{ Session::get('error_address') }}"><strong class="text-danger">download</strong></a> to download duplicate emails.</p>
        </div>
        @endif
    </div>
  </div>
  <div class="col-md-5 offset-1  grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="">
          @if(Session::has('success_final_import'))
            <p class="alert-success p-3">{{ Session::get('success_final_import') }}</p>
          @endif
          <div class="card-header mb-3">
            <h5 class="text-center">Final Edit</h5>
          </div>
              <a href="{{route('project-download-final')}}" class="mb-3 float-right">Download Sample</a>
        </div>
        <form class="forms-sample" method="post" action="{{ route('store-project-final-edit') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="final">
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="form-group">
            <label for="exampleInputUsername1">Select File</label>
            <input type="file" class="form-control file-upload-browse btn btn-primary" id="exampleInputUsername1"  name="final_edit_file">
            @error('address_file')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-success mr-2">Import</button>
        </form>
      </div>
        @if(Session::has('error_final'))
        <div class="card-footer">
            <p><span>Success. <strong class="text-success">{{ Session::get('newEntry') }}</strong> emails were imported.<span> We found {{ Session::get('count') }} duplicate emails. Click <a href="{{ Session::get('error_final') }}"><strong class="text-danger">download</strong></a> to download duplicate emails.</p>
        </div>
        @endif
    </div>
  </div>
</div>
