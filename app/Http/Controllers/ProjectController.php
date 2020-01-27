<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use App\Imports\AddressImport;
use App\Imports\EmailImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProjectImportRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
            Session()->put('tab', 2);
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
        $projectDetailEmails      = clone $projectDetail;
        $projectDetails           = $projectDetail->get();
        $projectDetailWithNumbers = $projectDetailWithNumbers
                                              ->whereNotNull('phone_number')
                                              ->orderBy('id', 'desc')
                                              ->paginate(100);
        $projectDetailEmails       = $projectDetailEmails
                                              ->whereNull('phone_number')
                                              ->get();

        if($projectDetails->count()) {
          Session()->put('step.first', 'completed');
          if($projectDetailWithNumbers->count()) {
              Session()->put('step.two', 'completed');
          }
        } else {
          if(Session()->has('step')){
            Session()->forget('step');
          }
          Session()->put('tab', 1);
        }

        $data['project']                 = $project;
        $data['projectDetails']          = $projectDetails;
        $data['projectWithPhoneNumbers'] = $projectDetailWithNumbers;
        $data['projectDetailEmails']     = $projectDetailEmails;

        return view('project.view', $data);
    }

    public function updateProjectDetail(Request $request)
    {
        $projectDetail  = ProjectDetail::findOrFail($request->id);

        $validColumns = ['recovery_mail','password','first_name','last_name','street_address','city','zip', 'state','state_abrevation', 'status', 'payment_status'];

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
        $validator = Validator::make($request->all(), [
            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'emails'        => ['required','max:5'],
            'phone_number'  => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                  $phoneCount = ProjectDetail::where('phone_number', $value)->count();
                    if ($phoneCount == 5) {
                        $fail('phone number can not be assign to more than 5 e-mails');
                    }
                },
            ],
        ]);

        if($validator->fails()) {
          Session()->put('tab', 2);
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

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
          Session()->put('tab', 3);
        }
        return redirect()
              ->route('project-setup', [$project->id])
              ->with(['success' => 'Phone Number Added Successfully']);
    }

    public function storeName(Request $request)
    {
        $rules = ['name'  => 'required|unique:projects'];
        $request->validate($rules);

        $project = Project::create([
          'name'    => $request->name,
          'user_id' => Auth::user()->id,
        ]);
        Session()->put('tab', 1);
        return redirect()
                ->route('project-setup', [$project->id])
                ->with(['success' => 'Project Created Successfully']);
    }

    public function downloadEmailSample(Request $request)
    {
        $file= public_path(). "/sampleFiles/email.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'email.xlsx', $headers);
    }

    public function downloadAddressSample(Request $request)
    {
        $file= public_path(). "/sampleFiles/address.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'address.xlsx', $headers);
    }
}
