<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use App\Imports\EmailImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProjectImportRequest;

use App\Models\Project;
use App\Models\ProjectDetail;
use Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('project.index', compact('projects'));
    }

    public function import()
    {
        return view('project.import');
    }

    public function create(Request $request)
    {
        $data = [];
        $projectName =  'Project#'.rand(9999, 11111111);

        if (!$request->session()->has('projectName') && !$request->session()->has('project_id')) {
          $request->session()->put('step', 1);
          $existingName = Project::where('name', $projectName)->first();
          if($existingName) {
            $projectName.= rand(11, 9999);
          }
          $request->session()->put('projectName', $projectName);
        }

        if($request->session()->has('project_id')) {
          $request->session()->put('step', 2);
          $id = $request->session()->get('project_id');
          $data['projectDetails'] = ProjectDetail::where('project_id', $id)->get();
        }
        $data['projectName']  = $request->session()->get('projectName');

        return view('project.create', $data);
    }

    public function store(ProjectImportRequest $request)
    {
        if($request->type == 'email') {
          $import = new EmailImport($request->id);
        }
        $import = new ProjectImport($request->id);
        $import->onlySheets('Prep');
        $data   = Excel::import($import, request()->file('file'));

        $message = "Emails Imported Successfully";

        if($request->type != 'mail') {
          $message = "Address Imported Successfully";
        }
        return redirect()->route('project-create')->with('success', $message);
    }

    public function show(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project->projectDetails()->count()) {
          Session()->put('step', 2);
        }
        return view('project.view', compact('project'));
    }

    public function updateProjectDetail(Request $request)
    {
        if (in_array($request->column, ['email', 'recovery_mail'])) {
          if ($request->column == 'email') {
            $request->request->add(['email' => $request->value]);
            $rules = ['email' => 'required|email|unique:project_details'];
          } else {
            $request->request->add(['recovery_mail' => $request->value]);
            $rules = ['recovery_mail' => 'required|email'];
          }

          $request->validate($rules);
        }

        $projectDetail  = ProjectDetail::findOrFail($request->id);

        $validColumns = ['email', 'recovery_mail', 'password'];

         if (in_array($request->column, $columns)) {
           $projectDetail->update([
             "{$request->column}"  => $request->value
           ]);
           return response(['success' => 'Project Updated successfully']);
         }

         return response(['error' => 'Something went wrong']);

    }

    public function assignEmails(Request $request)
    {
        $rules = [
          'first_name'    => 'required',
          'last_name'     => 'required',
          'phone_number'  => 'required|unique:project_details',
          'emails'        => 'required|array|max:5',
        ];
        $request->validate($rules);
        return redirect()->back();
    }

    public function storeName(Request $request)
    {
        $rules = ['name'  => 'required|unique:projects'];
        $request->validate($rules);

        $project = Project::create([
          'name'    => $request->name,
          'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('')->with(['success' => 'Project Created Successfully']);
    }

    public function destroProjectSession()
    {
        if(Session()->has('projectName')) {
          Session()->forget('projectName');
        }

        if(Session()->has('project_id')) {
          Session()->forget('project_id');
        }

        if(Session()->has('step')) {
          Session()->forget('step');
        }
        return response(['success' => 'session destroyed']);
    }
}
