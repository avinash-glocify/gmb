@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Projects</h2>
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
              @if(Auth::user()->isAdmin())
                  <a href="{{route('project-create')}}" class="btn btn-success mb-3 float-right btn-rounded">Create New Project</a>
              @endif
            </div>
            @if(Session::has('success'))
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <div class="alert alert-success col-md-12 text-center">
                  {{ Session::get('success')}}
                </div>
              </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="DataTable">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($projects as $key => $project)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$project->name}}</td>
                        <td>
                          <a  href="{{ route('project-setup', [$project->id]) }}" type="button" class="btn btn-md btn-success btn-rounded btn-fw p-2">View</a>
                          @if(Auth::user()->isAdmin())
                            <a  href="javascript:void(0);" data-url="{{ route('delete-project', [$project->id]) }}" type="button" class="btn btn-md btn-danger btn-rounded btn-fw del-btn p-2">Delete</a>
                          @endif
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5" class="text-center"><strong>No Data Found</strong></td>
                      </tr>
                      @endforelse
                    </tbody>
                </table>
          </div>
          <div class="float-right">
            {{ $projects->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
