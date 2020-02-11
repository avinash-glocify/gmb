<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(\App\Models\Files::class, 'refrence_id', 'id')->where('type', 'todos');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'type_id', 'id')->where('type', 'todo');
    }
}
