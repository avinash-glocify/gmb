@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Todo Detail</h2>
            <form class="forms-sample" method="post"  action="{{ route('todo.store') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Todo Name</label>
              <input type="text" class="form-control @error('client') is-invalid @enderror"  value="{{ old('name') }}"  name="name" placeholder="Todo Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}" name="description" placeholder="Todo Description" rows="4"></textarea>
              @error('description')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Assign Formula</label>
              <select class="form-control @error('formula') is-invalid @enderror"  name="formula" style="outline:none !important">
                <option value="">Select Formula</option>
                @foreach($formulas as  $formula)
                  <option value="{{ $formula->id }}">{{ $formula->name }}</option>
                @endforeach
              </select>
              @error('formula')
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
                  <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                @endforeach
              </select>
              @error('user')
              <span class="invalid-feedback ml-1 mt-1" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Assign Client</label>
              <select class="form-control @error('client') is-invalid @enderror"  name="client" style="outline:none !important">
                <option value="">Select Client</option>
                @foreach($clients as  $client)
                  <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
              </select>
              @error('client')
              <span class="invalid-feedback ml-1 mt-1" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
             <div class="mt-2">
                <button type="submit" class="btn btn-success mr-2">
                  Save
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
