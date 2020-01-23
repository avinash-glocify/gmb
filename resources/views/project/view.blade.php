@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Project Detail</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="">
                  <a href="{{route('project-list')}}" class="btn btn-primary mb-3 float-right">Back</a>
            </div>
            @if(Session::has('success'))
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <div class="alert alert-success col-md-12 text-center">
                  {{ Session::get('success')}}
                </div>
              </div>
            @endif
            <div class="table-responsive">
              @include('project.tabs.index')
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
