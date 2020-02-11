<div class="table-responsive mt-5">
    <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
              <th>#</th>
              <th>Date</th>
              <th>Who</th>
              <th>Description</th>
              <th>Start</th>
              <th>End</th>
              <th>Billable</th>
              <th>Time</th>
              <th>Hours</th>
          </tr>
        </thead>
        <tbody>
          @forelse($timespends as $key => $timespend)
          <tr>
            <td>{{ ++$timespend->id }}</td>
            <td> {{ $timespend->start_date }}</td>
            <td>{{ $timespend->user->full_name }}</td>
            <td> {{ $timespend->description }}</td>
            <td>{{ \Carbon\Carbon::parse($timespend->start_time)->format('H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($timespend->end_time)->format('H:i') }}</td>
            <td @if($timespend->billable)<i class="mdi mdi-check-circle btn-icon-append text-success" style="font-size:20px;"></i> @endif</td>
            <td>@if($timespend->hours > 0) {{ $timespend->hours }} hours @endif {{ $timespend->minuts }} mins</td>
            <td>{{ $timespend->hours }}.{{ $timespend->minuts}}</td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center"><strong>No Data Found</strong></td>
          </tr>
          @endforelse
        </tbody>
    </table>
