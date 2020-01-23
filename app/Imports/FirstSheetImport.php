<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Models\Project;
use App\Models\ProjectDetail;
use Auth, Session;

class FirstSheetImport implements ToArray
{
   public $params;
   public $type;

   public function __construct($params, $type)
   {
       $this->params     = $params;
       $this->type       = $type;
   }
    public function array(array $rows)
    {
        $user = Auth::user();
        $data = [];

        if($this->type == 'mail') {
          $project = Project::create([
            'name'    => $this->params,
            'user_id' => Auth::user()->id
          ]);
        }

        foreach ($rows as $key => $row) {
          if($key > 2) {
            if($row[11] != '' && $this->type == 'mail') {
              $data[$key] = [
                'project_id'       => $project->id,
                'email'            => $row[11],
                'password'         => $row[12] ?? Null,
                'recovery_mail'    => $row[13] ?? Null,
              ];

              $projectDetail = ProjectDetail::updateOrCreate(
                [
                  'email' => $row[11]
                ],
                  $data[$key]
              );

              if($projectDetail) {
                Session()->put('projectName', $project->name);
                Session()->put('project_id', $project->id);
              }
            } else {
              $data[$key] = [
                'street_address'   => $row[15] ?? Null,
                'city'             => $row[16] ?? Null,
                'state'            => $row[17] ?? Null,
                'state_abrevation' => $row[18] ?? Null,
                'zip'              => $row[19] ?? Null
              ];
            }
            if($projectDetail = ProjectDetail::where('email', $row[11] ?? Null)->first()) {
              $projectDetail->update($data[$key]);
            }
          }
        }
    }
}
