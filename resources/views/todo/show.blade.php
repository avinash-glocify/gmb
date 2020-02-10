@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Todo Detail</div>
          <div class="card-body">
            <p class="card-title d-inline-block card-description">{{ $todo->name }}</p>
            <div class="float-right">
              <button type="button" class="btn btn-success btn-sm  btn-icon-text" data-toggle="modal" data-target="#myModal">Edit<i class="mdi mdi-file-check btn-icon-append"></i></button>
              <a type="button" class="btn btn-info btn-sm btn-icon-text " href="{{ route('todo.index') }}">Back<i class="mdi mdi-arrow-left-bold"></i></a>
            </div>
            <div class="col-md-8"><p class="card-description"> {{ $todo->description }} </p></div>
          </div>
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Files</div>
          <div class="card-body">
            @if(!$todo->files->count())
              <p>No files are attached to this task? <a  href="#" data-toggle="modal" data-target="#fileUploadModal">Attach files to this task</i></a></p>
            @else
            @foreach($todo->files as $file)
              <img src="{{ $file->path }}" class="img-rounded mt-2" alt="Cinque Terre" width="120" height="100">
            @endforeach
            <div class="col-md-12 mt-5">
              <a  href="#" class="btn btn-success btn-sm  btn-icon-tex" data-toggle="modal" data-target="#fileUploadModal"><i class="mdi mdi-file-check btn-icon-append"></i>Upload Files</i></a>
            </div>
            @endif
          </div>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Time Logs</div>
          <div class="card-body">
            <div class="float-right">
              <button type="button" class="btn btn-success btn-sm  btn-icon-text" data-toggle="modal" data-target="#timeSpendModal">Log More Time<i class="mdi mdi-av-timer btn-icon-append"></i></button>
            </div>
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
                        <td @if($timespend->billable)<i class="mdi mdi-check-circle btn-icon-append text-success"></i> @endif</td>
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
          </div>
        </div>
      </div>
  </div>
</div>
  @include('todo.editModel')
  @include('todo.fileUploadModal')
  @include('todo.timeSpendModal')
@endsection
@section('extra_script')
@if(Session::has('update_error'))
  <script>
  $(window).on('load',function(){
    $('#myModal').modal('show');
    });
  </script>
@endif
@if(Session::has('file_error'))
  <script>
  $(window).on('load',function(){
    $('#fileUploadModal').modal('show');
    });
  </script>
@endif
@if(Session::has('timestamp_error'))
  <script>
  $(window).on('load',function(){
    $('#timeSpendModal').modal('show');
  });
  </script>
@endif
@endsection
