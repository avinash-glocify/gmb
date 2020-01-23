<div class="row">
  <div class="col-md-8 offset-2 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create User</h4>
        <form class="forms-sample" method="post" action="{{ route('project-assign-email') }}">
          @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername1" name="first_name" placeholder="First Name">
            @error('first_name')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername2" name="last_name" placeholder="Last Name">
            @error('last_name')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputphoneNumber" name="phone_number" placeholder="Phone Number">
            @error('phone_number')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Emails</label>
              <select class="mdb-select form-control md-form selectpicker @error('emails') is-invalid @enderror" multiple data-live-search="true" name="emails[]">
                @foreach($projectDetails as $key => $projectDetail)
                  <option value="{{ $projectDetail->id }}">{{ $projectDetail->email }}</option>
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
