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
        $creationDate = $project->creation_date ? Carbon::parse($project->creation_date)->format('m-d-Y') : '';

        $data = [
          'status'            => $project->status,
          'Creation Date'     => $creationDate,
          'Worker Name'       => $project->worker_name,
          'Gmail'             => $project->email,
          'Password'          => $project->password,
          'Recover Email'     => $project->recovery_mail,
          'Phone number'      => $project->phone_number,
          'GMB Lisiting Name' => $project->gmb_listing_name,
          'Full Name'         => $project->full_name,
          'GMB Name'          => $project->bussinessType->name ?? '',
          'GMB Category'      => $project->category->name ?? '',
          'Address'           => $project->street_address,
          'City'              => $project->city,
          'Abrev. State'      => $project->state_abrevation,
          'Country'           => $project->country,
          'Zip Code'          => $project->zip
        ];

        $this->project = [$data];
    }

    public function array():array
    {
        return $this->project;
    }

    public function headings(): array
    {
        return [
            'Status',
            'Creation Date',
            'Worker Name',
            'Gmail',
            'Password',
            'Recover Email',
            'Phone # to verify with',
            'GMB Listing Name',
            'Full Name',
            'GMB Name',
            'GMB Verification Category',
            'Address',
            'City',
            'Abrev. State',
            'Country',
            'Zip Code'
        ];
    }
}
