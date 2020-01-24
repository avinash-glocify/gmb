<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\ProjectDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AddressImport implements ToCollection, WithHeadingRow
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
          $projectDetail = ProjectDetail::where('email', $row['gmail'])->first();

          $data          = [
            'zip'               => $row['zip'] ?? Null,
            'city'              => $row['city'] ?? Null,
            'state'             => $row['full_state'] ?? Null,
            'state_abrevation'  => $row['abrev_st'] ?? Null,
            'street_address'    => $row['address_paste_here'] ?? Null,
          ];
          if($projectDetail) {
            if($projectDetail->project_id == $project->id) {
              $projectDetail->update($data);
            }
          } else {
            $data['email']      = $row['gmail'];
            $data['project_id'] = $project->id;
            $projectDetail      = ProjectDetail::create($data);
          }
          Session()->put('success', true);
        }
      }
    }
}
