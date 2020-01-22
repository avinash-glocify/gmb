<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function projectDetails()
    {
        return $this->hasMany(\App\Models\ProjectDetail::class);
    }
}
