@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <div class="form-group">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="projectName" value="{{ $projectName ?? '' }}"  name="name" placeholder="Project Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body dashboard-tabs p-0">
          <ul class="nav nav-tabs px-4 pb-4" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Set Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sales-tab" @if(Session()->get('step') == 2) data-toggle="tab" @endif href="#create" role="tab" aria-controls="sales" aria-selected="false">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" @if(Session()->has('mailImport')) data-toggle="tab" @endif id="purchases-tab" href="#edit" role="tab" aria-controls="purchases" aria-selected="false">Edit</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
              <div class="">
                @include('project.tabs.setup')
              </div>
            </div>
            <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="sales-tab">
              <div class="">
                @if(Session()->get('step') == 2)
                  @include('project.tabs.create')
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="purchases-tab">
              <div class="d-flex flex-wrap justify-content-xl-between">
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
