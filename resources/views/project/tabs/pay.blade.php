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
                <td>{{ $project->email }}</td>
                <td>{{ $project->phone_number }}</td>
                <td>{{ $project->payment_status }}</td>
                <td>{{ $project->first_name }}</td>
                <td>{{ $project->last_name }}</td>

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
