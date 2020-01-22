<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $fillable = ['mail', 'password', 'project_id', 'recovery_mail'];
}
