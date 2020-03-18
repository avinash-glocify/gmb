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
        <div class="card-body">
          
         
          
          </div>

        <div class="card-header">Time Logs</div>
          <div class="card-body">
             <div class="col-md-12 grid-margin stretch-card">
            <div class="col-md-3">
                   <h1 class="timeChk"><time>00:00:00</time></h1> 
            </div>
            <div class="col-md-3">
                  
            </div>
             <div class="col-md-2">
                <a href="javascript:void(0)" class="btn btn-rounded btn-success mb-3 float-right" id="start">Start Time</a>
            </div>
            <div class="col-md-2">
                 <a href="javascript:void(0)" class="btn btn-rounded btn-success mb-3 float-right" id="stop">Stop Time</a>
            </div>
             <div class="col-md-2" style="display: none">
                 <a href="javascript:void(0)" class="btn btn-rounded btn-success mb-3 float-right" id="clear">Clear Time</a>
            </div>
            <div class="float-right">
              <button type="button" class="btn btn-success btn-sm  btn-icon-text" data-toggle="modal" data-target="#timeSpendModal">Log Manual Time<i class="mdi mdi-av-timer btn-icon-append"></i></button>
            </div>
          </div>
            
             <div id= "tableDatatUpdate"></div>
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
  <input type="hidden" name="todoproject" id="todoproject" value="{{$todo->id}}">
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

  <script>

    var h1 = document.getElementsByTagName('h1')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}
function timer() {
       t = setTimeout(add, 1000);
   //var time=new Date().toLocaleTimeString();
    
}
//timer();


/* Start button */
start.onclick = timer;

/* Stop button */
stop.onclick = function() {
    clearTimeout(t);

    
}

/* Clear button */
clear.onclick = function() {
    h1.textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}

 $("#start").click(function(){
      var host = window.location.origin;

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var toDoId         = $('#todoproject').val();
        var timeStart      =new Date().toLocaleTimeString();
        
           $("#start").hide();
           $.ajax({
            url: '/todo/toDoTrackerStartProject',
            type: 'POST',
            data: {
                toDoId: toDoId,
                timeStart: timeStart
            },
            success: function(data) {
                
            }
          });
       
       
 }); 

 $("#stop").click(function(){

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var toDoId         = $('#todoproject').val();
        var timeEnd        =new Date().toLocaleTimeString();
         var gValue        =$('h1.timeChk').text();
       if(toDoId!='')
       {
           $("#start").hide();
           $.ajax({
            url: '/todo/toDoTrackerEndProject',
            type: 'POST',
            data: {
                toDoId: toDoId,
                timeEnd: timeEnd,
                gValue     :gValue
            },
            success: function(data) {
                //$("#tableDatatUpdate").html(data);
                $("#hidewhen").hide();
                location.reload();
            }
          });
       } 
       
 }); 
</script>
@endsection
