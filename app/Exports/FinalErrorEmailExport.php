<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FinalErrorEmailExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $errorMails;

    public function __construct($detail)
    {
        $this->errorMails = $detail;
    }

    public function array():array
    {
        return $this->errorMails;
    }

    public function headings(): array
    {
        $columns = config('projectEnum.finalColumns');
        unset($columns[1]);
        return $columns;
    }

}
