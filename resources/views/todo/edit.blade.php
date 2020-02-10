@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Update Todo Detail</h2>
            <form class="forms-sample" method="post"  action="{{ route('todo.update', [$todo->id]) }}">
              @csrf
              @method('PUT')
            <div class="form-group">
              <label for="exampleInputUsername1">Formula Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name', $todo->name) }}"  name="name" placeholder="Todo Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror"  value="{{ old('description', $todo->description) }}" name="description" placeholder="Todo Description" rows="4">{{ $todo->description }}</textarea>
              @error('description')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Assign User</label>
              <select class="form-control @error('user') is-invalid @enderror"  name="user" style="outline:none !important">
                <option value="">Select User</option>
                @foreach($users as  $user)
                  <option value="{{ $user->id }}" @if($todo->user_id == $user->id) selected @endif>{{ $user->full_name }}</option>
                @endforeach
              </select>
              @error('user')
              <span class="invalid-feedback ml-1 mt-1" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
             <div class="mt-2">
                <button type="submit" class="btn btn-success mr-2">
                  Update
                </button>
                <a  href="{{ route('todo.index') }}"class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
