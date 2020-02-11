@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Todo Detail</div>
          <div class="card-body todo-details">
            <p class="card-title d-inline-block card-description">{{ $todo->name }}</p>
            <div class="float-right">
              <button type="button" class="btn btn-success btn-sm  btn-icon-text" data-toggle="modal" data-target="#myModal">Edit<i class="mdi mdi-file-check btn-icon-append"></i></button>
              <a type="button" class="btn btn-info btn-sm btn-icon-text " href="{{ route('todo.index') }}">Back<i class="mdi mdi-arrow-left-bold"></i></a>
            </div>
            <div class="col-md-8"><p class="card-description"> {!! $todo->description !!} </p></div>
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
              @include('todo.timespend')
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Comments</div>
          <div class="card-body">
            @include('todo.comment')
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
  @if(Session::has('form_error'))
    <script>
    const text = "{{ Session::get('form_error') }}";
    $(window).on('load',function(){
      $(`#${text}`).modal('show');
      });
    </script>
  @endif
@endsection
