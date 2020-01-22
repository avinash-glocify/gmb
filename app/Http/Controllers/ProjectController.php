<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProjectImportRequest;

use App\Models\Project;
use App\Models\ProjectDetail;

class ProjectController extends Controller
{
    public function index()
    {
      $projects = Project::get();

      return view('project.index', compact('projects'));
    }

    public function import()
    {
        return view('project.import');
    }

    public function store(ProjectImportRequest $request)
    {
        $import = new ProjectImport($request->name);
        $import->onlySheets('Prep');
        $data   = Excel::import($import, request()->file('file'));

        return redirect()->route('project-list')->with('success', 'Project Imported Successfully');
    }

    public function show($id)
    {
        $projects = Project::findOrFail($id)->projectDetails()->paginate(100);
        return view('project.view', compact('projects'));
    }

    public function updateProjectDetail(Request $request)
    {
        $projectDetail  = ProjectDetail::findOrFail($request->id);

        $projectDetail->update([
          'mail'          => $request->column == 'email' ? $request->value : $projectDetail->mail,
          'recovery_mail' => $request->column == 'recovery_mail' ? $request->value : $projectDetail->recovery_mail,
          'password'      => $request->column == 'password' ? $request->value : $projectDetail->password,
        ]);
        return response(['success' => 'Project Updated successfully']);
    }
}
