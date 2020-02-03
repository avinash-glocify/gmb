<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Exports\FinalErrorEmailExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FinalImport implements ToCollection, WithHeadingRow
{
    protected $projectId;

    public function __construct($id)
    {
        $this->projectId = $id;
    }

    public function collection(Collection $rows)
    {
        $project = Project::findOrFail($this->projectId);

        $existsMails    = [];
        $notExistsMails = [];
        $newEntry       = 0;
        $errorMails     = 0;
        foreach ($rows as $key => $row) {
          if(isset($row['gmail'])) {

            $projectDetail      = Null;
            $verifiedProject    = ProjectDetail::where([
                                    'email'      => $row['gmail'],
                                    'status'     => 'Verified',
                                  ])
                                  ->first();
            if ($verifiedProject) {

              $data           = $this->getMappedData($row);
              $data['email']  = $row['gmail'];

              if ($verifiedProject->project_id == $project->id) {
                $projectDetail = $verifiedProject->update($data);
                $newEntry++;
              } else {
                array_push($existsMails, $row->toArray());
              }
            } else {
              array_push($notExistsMails, $row->toArray());
            }

            if($projectDetail) {
              Session()->put('success', true);
            }
          }
        }

        if(count($existsMails)) {
            $export  = new FinalErrorEmailExport($existsMails);
            $folder  = Carbon::now()->format('d-m-Y');

            $path    = storage_path('app/public/exportFiles/').$folder;
            $file    = 'email'.Carbon::now()->format('d-m-Y-h-i-s').'.csv';

            if (!file_exists($path)) {
              mkdir($path);
            }

             $filePath = '/exportFiles/'.$folder.'/'.$file;
             Excel::store($export, $filePath, 'public', \Maatwebsite\Excel\Excel::CSV);

             $downlink  = '/storage/exportFiles/'.$folder.'/'.$file;
             Session()->put([
               'final_error_mail.link'     => $downlink,
               'final_error_mail.count'    => count($existsMails),
               'final_error_mail.newEntry' => $newEntry,
              ]);
        }

        if(count($notExistsMails)) {
            Session()->put('error', true);
        }
    }

    public function getMappedData($row)
    {
        $data = $row->toArray();
        $data['credit_card_visa']             = $row['payments_credit_cards_pay_credit_card_types_accepted_visa_visa' ?? ''];
        $data['credit_card_master_card']      = $row['payments_credit_cards_pay_credit_card_types_accepted_mastercard_mastercard' ?? ''];
        $data['credit_card_american_express'] = $row['payments_credit_cards_pay_credit_card_types_accepted_american_express_american_express' ?? ''];
        return $data;
    }
}
