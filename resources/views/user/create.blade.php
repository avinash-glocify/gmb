@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 offset-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Add User</h2>
            @if(isset($user))
              <form class="forms-sample" method="post"  action="{{ route('update-user') }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
            @else
            <form class="forms-sample" method="post"  action="{{ route('store-user') }}">
            @endif
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">First Name</label>
              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputUsername1" value="{{ old('first_name', $user->first_name ?? '' ) }}"  name="first_name" placeholder="First Name">
              @error('first_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Last Name</label>
              <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputUsername2" value="{{ old('last_name', $user->last_name ?? '') }}" name="last_name" placeholder="Last Name">
              @error('last_name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('email', $user->email ?? '') }}" name="email" placeholder="Email">
              @error('email')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" value="{{ old('password') }}" name="password" placeholder="Password">
              @error('password')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputConfirmPassword1">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" @isset($user) && @if($user->is_admin) checked @endif @endisset> Admin <i class="input-helper"></i>
                   </label>
                 </div>
            </div>
            <div id="project_permissions">
            <div class="row" id="permissions">
              <div class="col-md-12">
                <hr>
                <label for="exampleInputPassword1">Permissions</label>
              </div>
              @foreach($permissions as $key => $permission)
                <div class="col-md-2">
                  <div class="form-group">
                     <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="permissions[{{$permission->id}}]" @isset($userPermission) && @if(in_array($permission->id, $userPermission)) checked @endif @endisset  @isset($user) && @if($user->is_admin) disabled @endif @endisset>{{ $permission->name }}<i class="input-helper"></i></label>
                     </div>
                  </div>
               </div>
               @endforeach
               @error('permissions')
                   <span class="invalid-feedback ml-1 mt-1" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
            </div>
            <div class="row" id="projects">
              <div class="col-md-12">
                <hr>
                <label for="exampleInputConfirmPassword1">Projects</label>
              </div>
              @foreach($projects as $key => $project)
                <div class="col-md-2">
                   <div class="form-group">
                      <div class="form-check">
                         <label class="form-check-label">
                         <input type="checkbox" class="form-check-input" name="projects[{{$project->id}}]" @isset($userProjectPermission) && @if(in_array($project->id, $userProjectPermission)) checked @endif @endisset @isset($user) && @if($user->is_admin) disabled @endif @endisset>{{ $project->name }}<i class="input-helper"></i></label>
                      </div>
                   </div>
                </div>
              @endforeach
              @error('projects')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
           </div>
           <div class="mt-2">
              <button type="submit" class="btn btn-success mr-2">
                @if(isset($user)) Update @else  {{ __('Register') }} @endif
              </button>
              <a  href="{{ route('users-list') }}"class="btn btn-danger">Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
