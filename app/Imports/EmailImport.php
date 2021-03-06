<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Exports\ErrorMailsExport;
use Maatwebsite\Excel\Facades\Excel;

use Session;
use Carbon\Carbon;

class EmailImport implements ToCollection, WithHeadingRow
{
    protected $projectId;

    public function __construct($id)
    {
      $this->projectId = $id;
    }

    public function collection(Collection $rows)
    {
        $project = Project::findOrFail($this->projectId);

        $existsMails = [];
        $newEntry    = 0;
        foreach ($rows as $key => $row) {
          if(isset($row['gmail'])) {
            $projectDetail      = Null;
            $existProjectDetail = ProjectDetail::where('email', $row['gmail'])->first();
            $data  = [
              'password'       => $row['password'] ?? Null,
              'recovery_mail'  => $row['recovery_email'] ?? Null,
            ];
            if($existProjectDetail) {
              if($existProjectDetail->project_id == $project->id) {
                $projectDetail = $existProjectDetail->update($data);
              } else {
                array_push($existsMails, $row->toArray());
              }
            } else {
              $data['email']      = $row['gmail'];
              $data['project_id'] = $project->id;
              $projectDetail = ProjectDetail::create($data);
              $newEntry++;
            }

            if($projectDetail) {
              Session()->put('success', true);
            }
          }
        }

        if(count($existsMails)) {
            $export  = new ErrorMailsExport($existsMails);
            $folder  = Carbon::now()->format('d-m-Y');

            $path    = storage_path('app/public/exportFiles/').$folder;
            $file    = 'email'.Carbon::now()->format('d-m-Y-h-i-s').'.csv';
            if(!file_exists($path)) {
              mkdir($path);
            }

             $filePath = '/exportFiles/'.$folder.'/'.$file;
             Excel::store($export, $filePath, 'public', \Maatwebsite\Excel\Excel::CSV);

             $downlink  = '/storage/exportFiles/'.$folder.'/'.$file;
             Session()->put([
               'error_mail.link'     => $downlink,
               'error_mail.count'    => count($existsMails),
               'error_mail.newEntry' => $newEntry,
              ]);
        }
      }
}
