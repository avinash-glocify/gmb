<table id="simpleEditableTable" class="table table-bordered">
    <tr>
      <th>#</th>
      <th>Email</th>
      <th>Password</th>
      <th>Recover Mail</th>
    </tr>
    @foreach($projects as $key => $project)
    <tr>
      <td>{{ ++$key }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="email">{{ $project->email }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="password">{{ $project->password }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="recovery_mail">{{ $project->recovery_mail }}</td>
    </tr>
    @endforeach
  </table>
  <div class="mt-5 float-right">
    {{ $projects->links() }}
  </div>
