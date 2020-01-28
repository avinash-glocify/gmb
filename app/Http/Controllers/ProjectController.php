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
use App\Models\BussinessType;
use App\Models\Category;
use Auth;
use Carbon\Carbon;

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
          $message = ['success' => "Data Imported Successfully"];
          Session()->forget('success');
        }
        return redirect()->route('project-setup', [$request->project_id])->with($message);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        return view('project.view', $data);
    }

    public function ceateSetup(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithEmail']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function editSetup(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithNumbers']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function getProjectDetailData($id)
    {
        $project             = Project::findOrFail($id);
        $projectDetail       = $project->projectDetails();
        $projectWithNumbers  = clone $projectDetail;
        $projectDetail       = $projectDetail->get();
        $projectWithNumbers  = $projectWithNumbers
                                      ->whereNotNull('phone_number')
                                      ->orderBy('phone_number', 'desc')
                                      ->paginate(100);

        $data =  [
          'project'            => $project,
          'projectWithEmail'   => $projectDetail,
          'projectWithNumbers' => $projectWithNumbers,
        ];

        return $data;
    }


    public function updateProjectDetail(Request $request)
    {
        $projectDetail  = ProjectDetail::findOrFail($request->id);

        $validColumns = ['recovery_mail','password','first_name','last_name','street_address','city','zip', 'state','state_abrevation', 'status', 'payment_status', 'bussiness_id', 'category_id'];

         if (in_array($request->column, $validColumns)) {
           $data = ["{$request->column}"  => $request->value];

           if($request->column == 'bussiness_id') {
             $bussinessType            = BussinessType::findOrFail($request->value);
             $name                     = $projectDetail->first_name.' '.$projectDetail->last_name.' '.$bussinessType->name;
             $data['gmb_listing_name'] = $name;
           }

           $projectDetail->update($data);
           return response(['data' => $projectDetail, 'success' => 'Project Updated successfully']);
         }

         return response(['error' => 'Something went wrong']);

    }

    public function assignEmails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'   => ['required'],
            'last_name'    => ['required'],
            'emails'       => [
                'required',
                'max:5',
                  function ($attribute, $value, $fail) {
                    $emailCount = ProjectDetail::whereNotNull('phone_number')->pluck('email')->toArray();
                    if(array_intersect($value, $emailCount)) {
                      $fail('phone number Already associated With these e-mails');
                    }
                  }
                ],
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
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $project = Project::findOrFail($request->project_id);

        foreach ($request->emails as $key => $email) {
          $projectDetail =  ProjectDetail::where('email', $email)->first();

          if($projectDetail) {
              $projectDetail->update([
                'first_name'       => $request->first_name,
                'last_name'        => $request->last_name,
                'phone_number'     => $request->phone_number,
                'gmb_listing_name' => $request->first_name. ' '. $request->last_name,
                'creation_date'    => Carbon::now()
              ]);
          }
        }
        return redirect()
              ->route('project-setup-edit', [$project->id])
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
