<div class="modal fade" id="timeSpendModal">
  <div class="modal-dialog modal-lg col-md-8">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Log Time on Task</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <form class="forms-sample" method="post"  action="{{ route('todo.timespend', [$todo->id]) }}">
          <p class="modal-title p-3 border-top-0 border"><span><strong>Task:</strong></span>    {{ $todo->name }}</p>
          <div class="modal-body">
            @csrf
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail">Who</label>
                  <select class="form-control @error('user') is-invalid @enderror"  name="user" style="outline:none !important">
                    <option value="">Select User</option>
                    @foreach($users as  $user)
                      <option value="{{ $user->id }}" @if($user->id == $todo->user_id) selected @endif>{{ $user->full_name }}</option>
                    @endforeach
                  </select>
                  @error('user')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail">Start Date</label>
                    <div class='input-group date' >
                        <input type='text' class="form-control" id='datetimepicker1' name="start_date" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    @error('start_date')
                        <span class="invalid-feedback ml-1 mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail">Start Time</label>
                  <div class='input-group time'>
                    <input type='text' class="form-control" id='datetimepicker2' name="start_time" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                  @error('start_time')
                      <span class="invalid-feedback ml-1 mt-1" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail">End Time</label>
                  <div class='input-group time' >
                    <input type='text' class="form-control" id='datetimepicker3' name="end_time" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                  @error('end_time')
                      <span class="invalid-feedback ml-1 mt-1" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group text-center">
                  <label for="exampleInputEmail">Time Spent</label>
                  <div class="row">
                    <div class="col-md-6 text-center">
                      <input type='text' class="form-control" name="timespend_hour" value="0" />
                      <label for="exampleInputEmail">Hours</label>
                      @error('timespend_hour')
                          <span class="invalid-feedback ml-1 mt-1" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="col-md-6 text-center">
                      <input type='text' class="form-control" name="timespend_minuts" value="10" />
                      <label for="exampleInputEmail">Minuts</label>
                      @error('timespend_minuts')
                          <span class="invalid-feedback ml-1 mt-1" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                   <div class="form-check mt-5">
                      <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="billable">Billable<i class="input-helper"></i></label>
                   </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="exampleInputUsername1">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}" name="description" placeholder="Todo Description" rows="4"></textarea>
                @error('description')
                    <span class="invalid-feedback ml-1 mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success mr-2">Log this time</button>
            <a  href="javascript:void(0);" data-dismiss="modal" class="btn btn-danger">Cancel</a>
          </div>
        </form>
    </div>
  </div>
</div>
