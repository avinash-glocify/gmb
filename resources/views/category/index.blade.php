@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Category</h2>
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
                  <a href="{{route('create-category')}}" class="btn btn-success mb-3 float-right">Add Category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($categories as $key => $category)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                          <a  href="javascript:void(0);" data-url="{{ route('delete-category', [$category->id]) }}" type="button" class="btn btn-sm btn-danger btn-rounded btn-fw del-btn">Delete</a>
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
                  {{ $categories->links() }}
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection