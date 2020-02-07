<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class TodoController extends Controller
{

    public function index()
    {
        $todos = ToDo::paginate(20);
        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required'];
        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
        ];

        $todo = ToDo::create($data);
        return redirect()->route('todo.index')->with(['success' => 'Todo added SuccessFully']);

    }

    public function show($id)
    {
        //
    }

    public function edit(ToDo $todo)
    {
      return view('todo.edit', compact('todo'));
    }

    public function update(Request $request, ToDo $todo)
    {
        $rules = ['name' => 'required'];
        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
        ];

        $todo->update($data);
        return redirect()->route('todo.index')->with(['success' => 'Todo Updated SuccessFully']);
    }

    public function destroy($id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->delete();
        return response(['success' => 'Todo Deleted successfully']);
    }
}
