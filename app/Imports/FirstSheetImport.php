<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\toArray;
use App\Models\Project;
use App\Models\ProjectDetail;

class FirstSheetImport implements toArray
{
  public $params;

   public function __construct($params)
   {
       $this->params = $params;
   }
    public function array(array $rows)
    {
        $data = [];

        $project = Project::create([
          'name' => $this->params
        ]);

        foreach ($rows as $key => $row) {
          if($key > 2 && $row[11] != '') {
            $data[$key] = [
              'project_id'    => $project->id,
              'mail'          => $row[11] ?? Null,
              'password'      => $row[12] ?? Null,
              'recovery_mail' => $row[13] ?? Null
            ];
            $projectDetail = ProjectDetail::create($data[$key]);
          }
        }
    }
}
