<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EditProjectDetailExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $project;

    public function __construct($project)
    {
        $project       = $this->getMappedData($project);
        $this->project = [$project];
    }

    public function array():array
    {
        return $this->project;
    }

    public function headings(): array
    {
        $columns = config('projectEnum.editColumns');
        return $columns;
    }

    public function getMappedData($project)
    {

      $data = [
          'Payment Status'   => $project->payment_status,
          'Status'           => $project->status,
          'Email'            => $project->email,
          'Phone Number'     => $project->phone_number,
          'Recovery Email'   => $project->recovery_mail,
          'Password'         => $project->password,
          'GMB Listing Name' => $project->gmb_listing_name,
          'Bussiness Type'   => $project->bussinessType->name ?? '',
          'GMB Category'     => $project->category->name ?? '',
          'First Name'       => $project->first_name,
          'Last Name'        => $project->last_name,
          'Steet Address'    => $project->street_address,
          'City'             => $project->city,
          'Zip'              => $project->zip,
          'State'            => $project->state,
          'State Abbrev.'    => $project->state_abrevation,
          'Creation Date'    => $project->creation_date
      ];
      return $data;
    }
}
