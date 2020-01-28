<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProjectDetail extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getProjectCreationDateAttribute()
    {
        return $this->creation_date ?  Carbon::parse($this->creation_date)->format('m-d-Y') : Carbon::now()->format('m-d-Y');
    }
}
