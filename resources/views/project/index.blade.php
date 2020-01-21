@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <p class="card-title mb-3">Projects</p>
                  <a href="{{route('import-project')}}" class="btn btn-success mb-3">Import Project</a>
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
                          <th>Project Name</th>
                          <th>Project Type</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Test</td>
                        <td>Design</td>
                        <td>
                          <a  href="javascript:void(0);" type="button" class="btn btn-sm btn-danger btn-rounded btn-fw">View</a>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Test</td>
                        <td>Design</td>
                        <td>
                          <a  href="javascript:void(0);" type="button" class="btn btn-sm btn-danger btn-rounded btn-fw">View</a>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Test</td>
                        <td>Design</td>
                        <td>
                          <a  href="javascript:void(0);" type="button" class="btn btn-sm btn-danger btn-rounded btn-fw">View</a>
                        </td>
                      </tr>
                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
