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
                @foreach($projectWithoutNumbers as $key => $projectDetail)
                  <option value="{{ $projectDetail->email }}">{{ $projectDetail->email }}</option>
                @endforeach
              </select>
              @error('emails')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          @if(!$projectWithoutNumbers->count())
            <div class="bg-danger rounded text-center text-white mb-2" role="alert">
              <p>Please import more emails to assign Phone Number.</p>
            </div>
          @endif
          <div class="form-group">
            <label for="exampleInputEmail">Payment Type</label>
            <select class="form-control @error('payment_type') is-invalid @enderror" name="payment_type" style="outline:none !important">
              <option value="">Select Payment Type</option>
              @foreach((config('projectEnum.paymentType')) as  $type)
                <option value="{{ $type }}">{{ $type }}</option>
              @endforeach
            </select>
            @error('payment_type')
            <span class="invalid-feedback ml-1 mt-1" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail">Payment Id</label>
            <input type="text" class="form-control @error('payment_id') is-invalid @enderror" name="payment_id" value="{{old('payment_id')}}" placeholder="Payment Id">
            @error('payment_id')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail">Referred By</label>
            <input type="text" class="form-control @error('referred_by') is-invalid @enderror" name="referred_by" value="{{old('referred_by')}}" placeholder="Referred By">
            @error('referred_by')
                <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary mr-2" @if(!$projectWithoutNumbers->count()) disabled @endif>Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
