<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ToDo;
use App\Models\Timespend;
use App\Models\Files;
use App\User;

class TodoController extends Controller
{

    public function index()
    {
        $todos = ToDo::paginate(20);
        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        $users = new User;
        $users = $users->getAllUsers();
        return view('todo.create',compact('users'));
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required', 'user' => 'required'];
        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
          'user_id'     => $request->user,
        ];

        $todo = ToDo::create($data);
        return redirect()->route('todo.index')->with(['success' => 'Todo added SuccessFully']);

    }

    public function show(ToDo $todo)
    {
        $users      = new User;
        $users      = $users->getAllUsers();
        $timespends = Timespend::get();

        $data = [
          'todo'       => $todo,
          'users'      => $users,
          'timespends' => $timespends,
        ];

        return view('todo.show', $data);
    }

    public function edit(ToDo $todo)
    {
      return view('todo.edit', compact('todo'));
    }

    public function update(Request $request, ToDo $todo)
    {
        $rules = ['name' => 'required', 'user' => 'required'];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return redirect()->back()->with(['update_error' => true ])->withErrors($validator->errors())->withInput();
        }

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
          'user_id'     => $request->user,
        ];

        $todo->update($data);
        return redirect()->back()->with(['success' => 'Todo Updated SuccessFully']);
    }

    public function destroy($id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->delete();
        return response(['success' => 'Todo Deleted successfully']);
    }

    public function fileupload(Request $request, $id)
    {
        $rules = ['files' => 'required'];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return redirect()->back()->with(['file_error' => true ])->withErrors($validator->errors())->withInput();
        }

        foreach ($request->file('files') as $key => $file) {
          $path = $this->storeFile($file);
          $uploadfile = Files::create(['path' => $path, 'type' => 'todos', 'refrence_id' => $id]);
        }

        return redirect()->back()->with(['success' => 'File Added SuccessFully']);
    }

    public function timespend(Request $request, $id)
    {
      $rules = [
        'start_date'         => 'required',
        'start_time'         => 'required',
        'end_time'           => 'required',
        'timespend_hour'     => 'required',
        'timespend_minuts'   => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if($validator->fails()) {
        return redirect()->back()->with(['timestamp_error' => true ])->withErrors($validator->errors())->withInput();
      }

      $data = [
        'user_id'      => $request->user,
        'todo_id'      => $id,
        'start_date'   => $request->start_date,
        'start_time'   => $request->start_time,
        'end_time'     => $request->end_time,
        'hours'        => $request->timespend_hour,
        'minuts'       => $request->timespend_minuts,
        'description'  => $request->description,
      ];
      if($request->has('billable'))
      {
        $data['billable'] = 1;
      }
        Timespend::create($data);
        return redirect()->back()->with(['success' => 'Time Added SuccessFully']);
    }
}
