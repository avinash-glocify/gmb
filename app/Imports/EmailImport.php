<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

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
              }
            } else {
              $data['email']      = $row['gmail'];
              $data['project_id'] = $project->id;
              $projectDetail = ProjectDetail::create($data);
            }

            if($projectDetail) {
              Session()->put('success', true);
            }
          }
        }
      }
}
