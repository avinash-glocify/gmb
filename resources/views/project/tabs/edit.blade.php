<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <tr>
              <th>#</th>
              @foreach(config('projectEnum.tableColumns') as $column)
                <th>{{ $column }}</th>
              @endforeach
            </tr>
              @foreach($projectWithNumbers as $key => $project)
              <tr>
                <td>{{ ++$key }}</td>
                <td data-id="{{ $project->id }}" data-name="status">
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="statusProject" data-id="{{ $project->id }}" data-name="status" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach(config('projectEnum.status') as $status)
                      <option value="{{ $status }}" @if($project->status === $status) Selected @endif >{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td  data-id="{{ $project->id }}" data-name="payment_status" >
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="statusProject" data-name="payment_status" data-id="{{ $project->id }}" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach(config('projectEnum.paymentStatus') as $status)
                      <option @if($project->payment_status === $status) Selected @endif value="{{ $status }}">{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td>
                  <div style="width: 100px">
                    {{ $project->project_creation_date }}
                  </div>
                </td>
                <td>{{ $project->email }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="password">{{ $project->password }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="recovery_mail">{{ $project->recovery_mail }}</td>
                <td data-id="{{ $project->id }}">
                  <div data-name="gmb_listing_name_{{ $project->id }}" style="width: 170px">
                    {{ $project->gmb_listing_name }}
                  </div>
                </td>
                <td>
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="gmb_name" data-id="{{ $project->id }}" data-name="bussiness_id" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach(\App\Models\BussinessType::get() as $type)
                      <option value="{{ $type->id }}" @if($project->bussiness_id == $type->id) Selected @endif >{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="gmb_name" data-id="{{ $project->id }}" data-name="category_id" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach(\App\Models\Category::get() as $type)
                      <option value="{{ $type->id }}" @if($project->category_id == $type->id) Selected @endif >{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="first_name" >{{ $project->first_name }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="last_name" >{{ $project->last_name }}</td>
                <td>{{ $project->phone_number }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="street_address">{{ $project->street_address }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="city">{{ $project->city }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="state">{{ $project->state }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="zip">{{ $project->zip }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="state_abrevation">{{ $project->state_abrevation }}</td>
              </tr>
              @endforeach
            </table>
          <div class="mt-5 float-right">
            {{ $projectWithNumbers->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
