<table id="simpleEditableTable" class="table table-bordered">
    <tr>
      <th>#</th>
      <th>Street</th>
      <th>City</th>
      <th>zip</th>
      <th>State</th>
      <th>State Code</th>
    </tr>
    @foreach($projects as $key => $project)
    <tr>
      <td>{{ ++$key }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="street_address">{{ $project->street_address }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="city">{{ $project->city }}</td>
      <td class="editMe" data-id="{{ $project->id }}" data-name="zip">{{ $project->zip }}</td>
    </tr>
    @endforeach
  </table>
  <div class="mt-5 float-right">
    {{ $projects->links() }}
  </div>
