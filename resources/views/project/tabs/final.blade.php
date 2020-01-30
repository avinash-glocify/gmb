<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <tr>
              <th>#</th>
              @foreach(config('projectEnum.finalColumns') as $column)
                <th>{{ $column }}</th>
              @endforeach
            </tr>
              @foreach($projectWithVerifyStatus as $key => $project)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $project->email }}</td>
                <td>{{ $project->phone_number }}</td>
                <td><a href="{{ route('project-export', [$project->id])}}" class="btn btn-success" title="Export">Export</a></td>
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
