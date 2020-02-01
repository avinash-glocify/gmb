<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <tr>
              <th>#</th>
              @foreach(config('projectEnum.paymentTable') as $column)
                <th>{{ $column }}</th>
              @endforeach
            </tr>
              @foreach($projectWithActiveStatus as $key => $project)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ \Carbon\Carbon::parse($project->creation_date)->format('d-m-Y') }}</td>
                <td>{{ $project->email }}</td>
                <td>{{ $project->phone_number }}</td>
                <td>{{ $project->first_name }}</td>
                <td>{{ $project->last_name }}</td>
                <td>{{ $project->phone_count }}</td>
                <td>{{ $project->payment_type }}</td>
                <td>{{ $project->payment_id }}</td>
                <td>{{ $project->referred_by }}</td>
                <td>
                  <div class="form-group" style="width:170px">
                    <select class="form-control" id="gmb_name" data-id="{{ $project->id }}" data-name="final_status" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                        @foreach(config('projectEnum.finalPaymentStatus') as $type)
                          <option value="{{ $type }}" @if($project->final_status == $type) Selected @endif >{{ $type }}</option>
                        @endforeach
                    </select>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          <div class="mt-5 float-right">
            {{ $projectWithVerifyStatus->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
