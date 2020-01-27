<div class="row">
  <div class="col-md-8 offset-2 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create User</h4>
        <form class="forms-sample" method="post" action="{{ route('project-assign-email') }}">
          @csrf
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="form-group">
            <label for="exampleInputUsername1">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername1" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
            @error('first_name')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputUsername2">Last Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername2" value="{{old('last_name')}}" name="last_name" placeholder="Last Name">
            @error('last_name')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputphoneNumber">Phone Number</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputphoneNumber" value="{{old('phone_number')}}" name="phone_number" placeholder="Phone Number">
            @error('phone_number')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail">Emails</label>
              <select class="mdb-select form-control md-form selectpicker @error('emails') is-invalid @enderror" id="exampleInputEmail" multiple data-live-search="true" name="emails[]">
                @foreach($projectDetailEmails as $key => $projectDetail)
                  <option value="{{ $projectDetail->email }}">{{ $projectDetail->email }}</option>
                @endforeach
              </select>
              @error('emails')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
