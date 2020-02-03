<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\ProjectImport;
use App\Imports\AddressImport;
use App\Imports\FinalImport;
use App\Imports\EmailImport;
use App\Exports\SingleProjectDetailExport;
use App\Exports\EditProjectDetailExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\BussinessType;
use App\Models\Category;
use Auth;
use Session;
use Carbon\Carbon;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $user     = Auth::user();
        $projects = $user->userProjects()->paginate(5);
        return view('project.index', compact('projects'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if(!$user->isAdmin()) {
          return redirect()->route('dashboard');
        }
        return view('project.create');
    }

    public function importEmails(Request $request)
    {
        $message = [];
        $rules   = ['email_file' => 'required|mimes:xlsx,csv'];

        $request->validate($rules);
        $import = new EmailImport($request->project_id);

        Excel::import($import, request()->file('email_file'));

        if(Session()->has('success')) {
          $message = ['success_email_import'   => " Success. Your all emails were imported"];
          Session()->forget('success');
        } else {
          $message    = ['error_import' => "Data Already Existed"];
        }

        if(Session()->has('error_mail.link')) {
            $message['error_mail']  = Session()->get('error_mail.link');
            $message['count']       = Session()->get('error_mail.count');
            $message['newEntry']    = Session()->get('error_mail.newEntry');
            unset($message['success_email_import' ?? '']);
            Session()->forget('error_mail');
        }
        return redirect()->route('project-setup', [$request->project_id])->with($message);
    }

    public function importAddress(Request $request)
    {
        $message = [];
        $rules   = ['address_file' => 'required|mimes:xlsx,csv'];

        $request->validate($rules);

        $import = new AddressImport($request->project_id);
        Excel::import($import, request()->file('address_file'));


        if(Session()->has('success')) {
          $message = ['success_address_import' => " Success. Your all Emails and Addresses are imported"];
          Session()->forget('success');
        } else {
          $message    = ['error_import' => "Data Already Existed"];
        }

        if(Session()->has('address_mail.link')) {
            $message['error_address'] = Session()->get('address_mail.link');
            $message['count']         = Session()->get('address_mail.count');
            $message['newEntry']      = Session()->get('address_mail.newEntry');
            unset($message['success_address_import' ?? '']);
            Session()->forget('address_mail');
        }

        return redirect()->route('project-setup', [$request->project_id])->with($message);
    }

    public function importFinalEdit(Request $request)
    {
        $message = [];
        $rules   = ['final_edit_file' => 'required|mimes:xlsx,csv'];

        $request->validate($rules);

        $import = new FinalImport($request->project_id);
        Excel::import($import, request()->file('final_edit_file'));


        if(Session()->has('success')) {
          $message = ['success_final_import' => " Success. Your all Verified Emails imported"];
          Session()->forget('success');
        } else {
          $message    = ['error_import' => "Data Already Existed"];
        }

        if(Session()->has('final_error_mail.link')) {
            $message['error_final']   = Session()->get('final_error_mail.link');
            $message['count']         = Session()->get('final_error_mail.count');
            $message['newEntry']      = Session()->get('final_error_mail.newEntry');
            unset($message['success_final_import' ?? '']);
            Session()->forget('address_mail');
        }

        return redirect()->route('project-setup', [$request->project_id])->with($message);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        return view('project.view', $data);
    }

    public function delete($id)
    {
        $user = Auth::user();

        if(!$user->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $project = Project::with('projectDetails')->findOrFail($id);
        $project->delete();

        return response(['success' => 'Project deleted successfully']);
    }

    public function ceateSetup(Request $request, $id)
    {
        $user   = Auth::user();
        if(!$user->hasCreatePermission()) {
          return redirect()->route('dashboard');
        }
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithEmail']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function editSetup(Request $request, $id)
    {
        $user   = Auth::user();

        if(!$user->hasEditPermission()) {
          return redirect()->route('dashboard');
        }
        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithNumbers']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function finalEditSetup(Request $request, $id)
    {
        $user   = Auth::user();

        if(!$user->hasFinalPermission()) {
          return redirect()->route('dashboard');
        }

        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithVerifyStatus']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function paySetup(Request $request, $id)
    {
        $user   = Auth::user();

        if(!$user->hasPayPermission()) {
          return redirect()->route('dashboard');
        }

        $project = Project::findOrFail($id);
        $data    = $this->getProjectDetailData($id);

        if(!$data['projectWithActiveStatus']->count()) {
          return redirect()->route('project-setup', [$project->id]);
        }

        return view('project.view', $data);
    }

    public function getProjectDetailData($id)
    {
        $project                = Project::findOrFail($id);
        $projectDetail          = $project->projectDetails();
        $projectWithNumbers     = clone $projectDetail;
        $projectDetail          = $projectDetail->get();

        $projectWithNumbers     = $projectWithNumbers
                                      ->whereNotNull('phone_number')
                                      ->orderBy('phone_number', 'desc')
                                      ->get()
                                      ->groupBy('phone_number');

        $projectWithoutNumbers      = $project->projectDetails()
                                        ->whereNull('phone_number')
                                        ->get();

        $projectWithNumbersCount    = $project->projectDetails()
                                      ->whereNotNull('phone_number')
                                      ->count();

        $projectWithoutNumbersCount = $project->projectDetails()
                                      ->whereNull('phone_number')
                                      ->count();

        $projectWithVerifyStatus    = $project->projectDetails()
                                      ->where('status', 'Verified')
                                      ->paginate(50);

        $projectWithActiveStatus    =   \DB::table('project_details')
                                        ->where(['payment_status' => 'Active Needs Payment', 'status' => 'Verified' , 'project_id' => $project->id])
                                        ->groupBy('project_details.phone_number')
                                        ->select('*', \DB::raw('count(*) as phone_count'))
                                        ->paginate(50);

        $data =  [
          'project'                    => $project,
          'projectWithEmail'           => $projectDetail,
          'projectWithNumbers'         => $projectWithNumbers,
          'projectWithoutNumbersCount' => $projectWithoutNumbersCount,
          'projectWithoutNumbers'      => $projectWithoutNumbers,
          'projectWithNumbersCount'    => $projectWithNumbersCount,
          'projectWithVerifyStatus'    => $projectWithVerifyStatus,
          'projectWithActiveStatus'    => $projectWithActiveStatus
        ];

        return $data;
    }


    public function updateProjectDetail(Request $request)
    {
        $projectDetail  = ProjectDetail::findOrFail($request->id);
        $validColumns   = $projectDetail->getFields();

         if (in_array($request->column, $validColumns)) {

           $data = ["{$request->column}"  => $request->value];

           if($request->column == 'bussiness_id') {
             $bussinessType            = BussinessType::findOrFail($request->value);
             $name                     = $projectDetail->first_name.' '.$bussinessType->name;
             $data['gmb_listing_name'] = $name;
           }

           if($request->column == 'first_name') {
              $bussinessType            = BussinessType::findOrFail($projectDetail->bussiness_id);
              $name                     = $request->value.' '.$bussinessType->name;
              $data['gmb_listing_name'] = $name;
           }

           if($request->column == 'payment_status') {
             $projectDetail = ProjectDetail::where('phone_number', $projectDetail->phone_number);
           }

           $projectDetail->update($data);
           return response(['data' => $projectDetail, 'success' => 'Project Updated successfully']);
         }

         return response(['error' => 'Something went wrong']);

    }

    public function assignEmails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'      => ['required'],
            'last_name'       => ['required'],
            'payment_type'    => ['required'],
            'emails'          => [
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
                'payment_status'   => 'In Progress',
                'gmb_listing_name' => $request->first_name,
                'final_status'     => 'Need Payments',
                'payment_type'     => $request->payment_type,
                'referred_by'      => $request->referred_by ?? '',
                'payment_id'       => $request->payment_id ?? '',
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
        $file    = public_path(). "/sampleFiles/Email_Sample.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'email.xlsx', $headers);
    }

    public function downloadAddressSample(Request $request)
    {
        $file    = public_path(). "/sampleFiles/address_phone_sample.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'address.xlsx', $headers);
    }

    public function downloadfinalSample(Request $request)
    {
        $file    = public_path(). "/sampleFiles/final_edit_sample.xlsx";
        $headers = array('Content-Type: application/xlsx');
        return Response::download($file, 'final.xlsx', $headers);
    }

    public function exportFinal($id)
    {
        $projectDetail  = ProjectDetail::findOrFail($id);
        $export         = new SingleProjectDetailExport($projectDetail);
        return Excel::download($export, 'project.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportEdit($id)
    {
        $projectDetail  = ProjectDetail::findOrFail($id);
        $export         = new EditProjectDetailExport($projectDetail);
        return Excel::download($export, 'project.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
