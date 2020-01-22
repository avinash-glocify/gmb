<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class ProjectImport implements WithMultipleSheets
{
     use WithConditionalSheets;

     protected $params;

      public function __construct($params)
      {
          $this->params = $params;
      }

    public function conditionalSheets(): array
    {
        return [
            'Prep' => new FirstSheetImport($this->params)
        ];
    }
}
