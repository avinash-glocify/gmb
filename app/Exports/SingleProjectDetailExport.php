<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Carbon\Carbon;

class SingleProjectDetailExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $project;

    public function __construct($project)
    {
        $project       = $project->getFinalMappedData();
        $this->project = [$project];
    }

    public function array():array
    {
        return $this->project;
    }

    public function headings(): array
    {
        $columns = config('projectEnum.finalColumns');
        unset($columns[0]);
        unset($columns[1]);
        unset($columns[41]);
        return $columns;
    }
}
