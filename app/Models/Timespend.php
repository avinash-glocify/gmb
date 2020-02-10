<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timespend extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function todo()
    {
        return $this->belongsTo(\App\Models\ToDo::class);
    }
}
