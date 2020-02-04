<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive">
            <tr>
              <th>#</th>
              @foreach(config('projectEnum.tableColumns') as $column)
                <th>{{ $column }}</th>
              @endforeach
              <th>Action</th>
            </tr>
              @foreach($projectWithNumbers as $phoneKey => $projectDetail)
                  @php $phoneCount = \App\Models\ProjectDetail::where('phone_number', $phoneKey)->count(); @endphp
                @foreach($projectDetail as $key => $project)
                  <tr>
                  <td>{{ ++$key }}</td>
                  @if($key == 1)
                  <td  data-id="{{ $phoneKey }}" data-name="payment_status" rowspan="{{ $phoneCount }}" >
                    <div class="form-group" style="width:170px">
                      <select class="form-control" id="statusProject" data-name="payment_status" data-id="{{ $project->id }}" onchange="updatePayementStatus(event)">
                        <option value="">Select Status</option>
                        @foreach(config('projectEnum.paymentStatus') as $status)
                        <option @if($project->payment_status === $status) Selected @endif value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                  @endif
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
                  <td>{{ $project->phone_number }}</td>
                  <td>{{ $project->email }}</td>
                  <td>{{ $project->password }}</td>
                  <td>{{ $project->recovery_mail }}</td>
                  <td >{{ $project->first_name }}</td>
                  <td>{{ $project->last_name }}</td>
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
                  <td class="editMe" data-id="{{ $project->id }}" data-name="street_address">{{ $project->street_address }}</td>
                  <td class="editMe" data-id="{{ $project->id }}" data-name="city">{{ $project->city }}</td>
                  <td class="editMe" data-id="{{ $project->id }}" data-name="state">{{ $project->state }}</td>
                  <td class="editMe" data-id="{{ $project->id }}" data-name="zip">{{ $project->zip }}</td>
                  <td class="editMe" data-id="{{ $project->id }}" data-name="state_abrevation">{{ $project->state_abrevation }}</td>
                  <td>
                    <div style="width: 100px">
                      {{ $project->project_creation_date }}
                    </div>
                  </td>
                  <td><a href="{{ route('project-edit-export', [$project->id])}}" class="btn btn-success" title="Export">Export</a></td>
                </tr>
                @endforeach
              @endforeach
            </table>
      </div>
    </div>
  </div>
</div>
