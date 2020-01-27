@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Project Setup</h2>
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
              <a class="nav-link  @if(Session()->get('tab') == 1) active @endif" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Set Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Session()->get('tab') == 2) active @endif" id="sales-tab" @if(Session()->get('step.first') == 'completed') data-toggle="tab" @endif href="#create" role="tab" aria-controls="sales" aria-selected="false">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Session()->get('tab') == 3) active @endif" @if(Session()->get('step.two') == 'completed') data-toggle="tab" @endif id="purchases-tab" href="#edit" role="tab" aria-controls="purchases" aria-selected="false">Edit</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="tab-content py-0 px-0">
            <div class="tab-pane fade @if(Session()->get('tab') == 1)  show active @endif" id="overview" role="tabpanel" aria-labelledby="overview-tab">
              <div class="">
                @include('project.tabs.setup')
              </div>
            </div>
            <div class="tab-pane fade @if(Session()->get('tab') == 2) show active @endif" id="create" role="tabpanel" aria-labelledby="sales-tab">
              <div class="">
                @if($projectDetails->count())
                  @include('project.tabs.create')
                @endif
              </div>
            </div>
            <div class="tab-pane fade @if(Session()->get('tab') == 3) show active @endif" id="edit" role="tabpanel" aria-labelledby="purchases-tab">
              <div class="flex-wrap justify-content-xl-between">
                @if($projectWithPhoneNumbers->count())
                  @include('project.tabs.edit')
                @endif
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
