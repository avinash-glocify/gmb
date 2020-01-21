<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    public function index()
    {
      return view('project.index');
    }

    public function import()
    {
        return view('project.import');
    }

    public function store(Request $request)
    {
        $rules = [
          'file'         => 'required',
          'project_name' => 'required',

        ];
       $request->validate($rules);
       return back();
        // Excel::import(new ProjectImport, request()->file('file'));
    }
}
