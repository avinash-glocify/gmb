@php $tableColumns = ['Email','Password','Recover Mail','First Name','Last Name','Phone Number','Street','City','State','Zip', 'State Code', 'Status', 'Payment Status'] @endphp
@php
  $statusColumns = ['Verified', 'Hard Pending', 'Soft Pending', 'Post Card', 'Suspended', 'Skipped'];
  $paymentStatusColumns = ['In Progress', 'Active Needs Payment', 'Rejected'];
@endphp

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <tr>
              <th>#</th>
              @foreach($tableColumns as $column)
              <th @if(in_array($column, ['First Name', 'Last Name', 'Street', 'Status'])) colspan="3" @endif>{{ $column }}</th>
              @endforeach
            </tr>
              @foreach($projectWithPhoneNumbers as $key => $project)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $project->email }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="password">{{ $project->password }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="recovery_mail">{{ $project->recovery_mail }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="first_name" colspan="3">{{ $project->first_name }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="last_name" colspan="3">{{ $project->last_name }}</td>
                <td>{{ $project->phone_number }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="street_address" colspan="3">{{ $project->street_address }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="city">{{ $project->city }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="state">{{ $project->state }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="zip">{{ $project->zip }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="state_abrevation">{{ $project->state_abrevation }}</td>
                <td data-id="{{ $project->id }}" data-name="status" colspan="3">
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="statusProject" data-id="{{ $project->id }}" data-name="status" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach($statusColumns as $status)
                        <option value="{{ $status }}" @if($project->status === $status) Selected @endif >{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td  data-id="{{ $project->id }}" data-name="payment_status" >
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="statusProject" data-name="payment_status" data-id="{{ $project->id }}" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach($paymentStatusColumns as $status)
                        <option @if($project->payment_status === $status) Selected @endif value="{{ $status }}">{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          <div class="mt-5 float-right">
            {{ $projectWithPhoneNumbers->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
