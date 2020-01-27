@php $tableColumns = ['Email','Password','Recover Mail','First Name','Last Name','Phone Number','Street','City','State','Zip', 'State Code', 'Status', 'Payment Status'] @endphp
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <tr>
              <th>#</th>
              @foreach($tableColumns as $column)
              <th @if(in_array($column, ['First Name', 'Last Name', 'Street'])) colspan="3" @endif>{{ $column }}</th>
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
                <td class="editMe" data-id="{{ $project->id }}" data-name="status">{{ $project->status }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="payment_status">{{ $project->payment_status }}</td>
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
