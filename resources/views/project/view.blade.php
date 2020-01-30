@extends('layouts.auth')
@section('content')
@php $tab = Request::segment(2);  @endphp
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body dashboard-tabs p-0">
          <ul class="nav nav-tabs px-4 pb-4" role="tablist">
            <li class="nav-item">
              <a class="nav-link  @if($tab == 'setup') active @endif" id="overview-tab"  href="{{ route('project-setup', $project->id) }}"role="tab" aria-controls="overview" aria-selected="true">SET UP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if($tab == 'create') active @endif" id="create-tab" @if($projectWithEmail->count()) href="{{ route('project-setup-create', $project->id) }}" @else href="#create"  @endif  role="tab" aria-controls="create" aria-selected="false">CREATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if($tab == 'edit') active @endif" @if($projectWithNumbers->count()) href="{{ route('project-setup-edit', $project->id) }}" @else href="#edit" @endif id="edit-tab" role="tab" aria-controls="edit" aria-selected="false">EDIT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if($tab == 'final') active @endif" @if($projectWithVerifyStatus->count()) href="{{ route('project-setup-final-edit', $project->id) }}" @else href="#final" @endif id="final-tab" role="tab" aria-controls="final" aria-selected="false">FINAL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if($tab == 'pay') active @endif" @if($projectWithActiveStatus->count()) href="{{ route('project-setup-pay', $project->id) }}" @else href="#pay" @endif id="pay-tab" role="tab" aria-controls="pay" aria-selected="false">PAY</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="tab-content py-0 px-0">
            <div class="">
              @if($tab == 'edit')
                @include('project.tabs.edit')
              @elseif($tab == 'create')
                @include('project.tabs.create')
              @elseif($tab == 'final')
                @include('project.tabs.final')
              @elseif($tab == 'pay')
                @include('project.tabs.pay')
              @else
                @include('project.tabs.setup')
              @endif
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
