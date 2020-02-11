<form class="forms-sample" method="post"  action="{{ route('todo.comment', [$todo->id]) }}">
  @csrf
  <div class="form-group">
    <label for="exampleInputUsername1">Comment</label>
    <textarea id="commentnote"  class="form-control @error('content') is-invalid @enderror"  value="{{ old('content') }}" name="content" placeholder="Add Your comment here" rows="4"></textarea>
    @error('content')
    <span class="invalid-feedback ml-1 mt-1" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="sub-cmt-btn d-none">
    <button type="submit" class="btn btn-success mr-2">
      save
    </button>
    <a  href="#" onclick="toggleBtns()" class="btn btn-danger">Cancel</a>
  </div>
</form>
<div class="todo-details">
  @foreach($todo->comments as $key => $comment)
  <hr>
  <p class="card-title d-inline-block card-description"><strong>{{ $comment->user->full_name }}</strong></p>
  <p class="float-right">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
  <div class="col-md-8"><p class="card-description"> {!! $comment->content !!} </p></div>
  @endforeach
</div>
