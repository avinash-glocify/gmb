@extends('layouts.auth')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12  grid-margin stretch-card">
      <div class="card">
        <div class="card-header">Client Detail</div>
          <div class="card-body todo-details">
            <p class="card-title d-inline-block card-description">{{ $client->name }}</p>
            <div class="float-right">
              <a type="button" class="btn btn-info btn-sm btn-icon-text " href="{{ route('client.index') }}">Back<i class="mdi mdi-arrow-left-bold"></i></a>
            </div>
            <div class="col-md-8"><p class="card-description"> {!! $client->description !!} </p></div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
