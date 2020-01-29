<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
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

        foreach ($rows as $key => $row) {
          if(isset($row['gmail'])) {
            $projectDetail = ProjectDetail::where('email', $row['gmail'])->first();

            $data          = [
              'zip'               => $row['zip'] ?? Null,
              'city'              => $row['city'] ?? Null,
              'state'             => $row['state'] ?? Null,
              'state_abrevation'  => $row['abrev_st'] ?? Null,
              'street_address'    => $row['address'] ?? Null,
              'country'           => $row['country'] ?? Null,
            ];
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
              Session()->put('success', true);
            }
          }
        }

        if(count($existsMails)) {
            $export  = new ErrorAddressExport($existsMails);

            $folder  = Carbon::now()->format('d-m-Y');

            $path    = storage_path('app/public/exportFiles/').$folder;
            $file    = 'addresses and phone numbers'.strtotime("now").'.xlsx';

            if(!file_exists($path)) {
              mkdir($path);
            }

             $filePath = '/exportFiles/'.$folder.'/'.$file;
             Excel::store($export, $filePath, 'public');
             $downlink  = '/storage/exportFiles/'.$folder.'/'.$file;
             Session()->put(['address_mail.link' => $downlink, 'address_mail.count' => count($existsMails)]);
        }
    }
}
