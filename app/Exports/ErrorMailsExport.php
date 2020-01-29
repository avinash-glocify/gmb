<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ErrorMailsExport implements FromArray, WithHeadings, ShouldAutoSize
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
        $headings = array_filter(array_keys($this->errorMails[0]));

        $data =[];

        foreach ($headings as $value) {
          array_push($data, ucfirst(str_replace('_', ' ',$value)));
        }

        return $data;
    }

}
