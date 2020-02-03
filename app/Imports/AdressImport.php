<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\BussinessType;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Exports\ErrorAddressExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AddressImport implements ToCollection, WithHeadingRow
{
    protected $projectId;

    public function __construct($id)
    {
        $this->projectId = $id;
    }

    public function collection(Collection $rows)
    {
        $project     = Project::findOrFail($this->projectId);
        $existsMails = [];
        $newEntry    = 0;

        foreach ($rows as $key => $row) {

          if(isset($row['gmail'])) {

            $projectDetail = ProjectDetail::where('email', $row['gmail'])->first();
            $bussinessType = BussinessType::where('name', $row['gmb_name'] ?? '')->first();
            $bussinessCate = Category::where('name', $row['gmb_verification_category'] ?? '')->first();

            $data          = [
              'zip'               => $row['zip'] ?? Null,
              'city'              => $row['city'] ?? Null,
              'state'             => $row['state'] ?? Null,
              'state_abrevation'  => $row['abrev_st'] ?? Null,
              'street_address'    => $row['address'] ?? Null,
              'country'           => $row['country'] ?? Null,
              'bussiness_id'      => $bussinessType->id ?? Null,
              'category_id'       => $bussinessCate->id ?? Null,
              'gmb_listing_name'  => $row['gmb_listing_name'] ?? Null,
              'payment_status'    => $row['payment_status'] ?? Null,
              'status'            => $row['status'] ?? Null,
              'first_name'        => $row['first_name'] ?? Null,
              'last_name'         => $row['last_name'] ?? Null,
            ];

            $projectPhoneDetail = ProjectDetail::where('phone_number', $row['phone_numbers'] ?? '')->count();

            if($projectPhoneDetail < 5) {
              $data['phone_number'] = $row['phone_numbers'] ?? Null;
            }

            if($projectDetail) {
              if($projectDetail->project_id == $project->id) {
                $projectDetail->update($data);
                Session()->put('success', true);
              } else {
                array_push($existsMails, $row->toArray());
              }
            } else {
              $data['email']      = $row['gmail'];
              $data['project_id'] = $project->id;
              $projectDetail      = ProjectDetail::create($data);
              $newEntry++;
              Session()->put('success', true);
            }
          }
        }

        if(count($existsMails)) {
            $export  = new ErrorAddressExport($existsMails);

            $folder  = Carbon::now()->format('d-m-Y');

            $path    = storage_path('app/public/exportFiles/').$folder;
            $file    = 'addresses and phone numbers'.Carbon::now()->format('d-m-Y-h-i-s').'.csv';

            if(!file_exists($path)) {
              mkdir($path);
            }

             $filePath = '/exportFiles/'.$folder.'/'.$file;
             Excel::store($export, $filePath, 'public', \Maatwebsite\Excel\Excel::CSV);
             $downlink  = '/storage/exportFiles/'.$folder.'/'.$file;

             Session()->put([
               'address_mail.link'     => $downlink,
               'address_mail.count'    => count($existsMails),
               'address_mail.newEntry' => $newEntry
             ]);
        }
    }
}
