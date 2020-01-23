<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class ProjectImport implements WithMultipleSheets
{
     use WithConditionalSheets;

     protected $params;
     protected $type;

      public function __construct($params, $type = 'mail')
      {
          $this->params = $params;
          $this->type   = $type;
      }

    public function conditionalSheets(): array
    {
        return [
            'Prep' => new FirstSheetImport($this->params, $this->type)
        ];
    }
}
