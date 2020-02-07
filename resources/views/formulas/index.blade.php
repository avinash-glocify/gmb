@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Formulas</h2>
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
                  <a href="{{route('formulas.create')}}" class="btn btn-rounded btn-success mb-3 float-right">New Formula</a>
            </div>
            @if(Session::has('success'))
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <div class="alert alert-success col-md-12 text-center">
                  {{ Session::get('success')}}
                </div>
              </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Created</th>
                          <th>Last Updated</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($formulas as $key => $formula)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$formula->name}}</td>
                        <td>{{$formula->description}}</td>
                        <td>{{ \Carbon\Carbon::parse($formula->created_at)->format('d-M-Y h:i:A')}}</td>
                        <td>{{ \Carbon\Carbon::parse($formula->updated_at)->format('d-M-Y h:i:A')}}</td>
                        <td>
                          <a  href="javascript:void(0);" data-url="{{ route('formulas.delete', [$formula->id]) }}" type="button" class="btn btn-md btn-danger btn-rounded btn-fw del-btn mt-2">Delete</a>
                          <a  href="{{ route('formulas.edit', [$formula->id]) }}" type="button" class="btn btn-md btn-info btn-rounded btn-fw mt-2">Edit</a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5" class="text-center"><strong>No Data Found</strong></td>
                      </tr>
                      @endforelse
                    </tbody>
                </table>
                <div class="float-right">
                  {{ $formulas->links() }}
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
