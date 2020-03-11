<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg col-md-8">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Todo Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <form class="forms-sample" method="post"  action="{{ route('todo.update', [$todo->id]) }}">
          <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="exampleInputUsername1">Todo Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name', $todo->name) }}"  name="name" placeholder="Todo Name">
              @error('name')
                  <span class="invalid-feedback ml-1 mt-1" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Description</label>
              <textarea id="summernote" class="form-control @error('description') is-invalid @enderror"  value="{{ old('description', $todo->description) }}" name="description" placeholder="Todo Description" rows="4">{{ $todo->description }}</textarea>
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
                  <option value="{{ $formula->id }}" @if($formula->id == $todo->formula_id) selected @endif>{{ $formula->name }}</option>
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
                  <option value="{{ $user->id }}" @if($user->id == $todo->user_id) selected @endif>{{ $user->full_name }}</option>
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
                  <option value="{{ $client->id }}" @if($client->id == $todo->client_id) selected @endif>{{ $client->name }}</option>
                @endforeach
              </select>
              @error('client')
              <span class="invalid-feedback ml-1 mt-1" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success mr-2">Update</button>
          <a  href="javascript:void(0);" data-dismiss="modal" class="btn btn-danger">Cancel</a>
        </div>
    </form>

    </div>
  </div>
</div>
