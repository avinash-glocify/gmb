<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use App\Imports\AddressImport;
use App\Imports\EmailImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProjectImportRequest;
use Illuminate\Support\Facades\Response;

use App\Models\Project;
use App\Models\ProjectDetail;
use Auth;

class ProjectController extends Controller
{

    public function create(Request $request)
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $rules = [];
        if($request->type == 'email') {
          $import = new EmailImport($request->project_id);
          $rules  = ['email_file' => 'required'];
        } else {
          $import = new AddressImport($request->project_id);
          $rules  = ['address_file' => 'required'];
        }
        $request->validate($rules);

        if($request->type == 'email') {
          Excel::import($import, request()->file('email_file'));
        } else {
          Excel::import($import, request()->file('address_file'));
        }
        $message = ['error' => "Data Already Existed"];

        if(Session()->has('success')) {
          Session()->put('step, 2');
          $message = ['success' => "Data Imported Successfully"];
          Session()->forget('success');
        }
        return redirect()->route('project-setup', [$request->project_id])->with($message);
    }

    public function show(Request $request, $id)
    {
        $project                  = Project::findOrFail($id);
        $projectDetail            = $project->projectDetails();
        $projectDetailWithNumbers = clone $projectDetail;
        $projectDetailCount       = clone $projectDetail;

        if($projectDetailCount->count()) {
          Session()->put('step', 2);
        } else {
          if(Session()->has('step')){
            Session()->forget('step');
          }
        }

        $data['projectDetails']          = $projectDetail->get();
        $data['project']                 = $project;
        $data['projectWithPhoneNumbers'] = $projectDetailWithNumbers
                                              ->whereNotNull('phone_number')
                                              ->paginate(100);

        return view('project.view', $data);
    }

    public function updateProjectDetail(Request $request)
    {
        $projectDetail  = ProjectDetail::findOrFail($request->id);

        $validColumns = ['recovery_mail','password','first_name','last_name','street_address','city','zip', 'state','state_abrevation'];

         if (in_array($request->column, $validColumns)) {
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
          'phone_number'  => 'required',
          'emails'        => 'required|array|max:5',
        ];
        $request->validate($rules);
        $project = Project::findOrFail($request->project_id);

        foreach ($request->emails as $key => $email) {
          $projectDetail =  ProjectDetail::where('email', $email)->first();

          if($projectDetail) {
              $projectDetail->update([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'phone_number' => $request->phone_number,
              ]);
          }
        }
        return redirect()
              ->route('project-setup', [$project->id])
              ->with(['success' => 'Phone Number Added Successfully', 'editTab' => true]);
    }

    public function storeName(Request $request)
    {
        $rules = ['name'  => 'required|unique:projects'];
        $request->validate($rules);

        $project = Project::create([
          'name'    => $request->name,
          'user_id' => Auth::user()->id,
        ]);

        return redirect()
                ->route('project-setup', [$project->id])
                ->with(['success' => 'Project Created Successfully']);
    }

    public function downloadEmailSample(Request $request)
    {
        $file= public_path(). "\sampleFiles\\email.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'email.xlsx', $headers);
    }

    public function downloadAddressSample(Request $request)
    {
        $file= public_path(). "\sampleFiles\address.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'address.xlsx', $headers);
    }
}
