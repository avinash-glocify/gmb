<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(\App\Models\Files::class, 'refrence_id', 'id')->where('type', 'formulas');
    }
}
