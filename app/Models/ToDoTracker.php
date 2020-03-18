<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoTracker extends Model
{
    protected $fillable = [
      'id','user_id', 'todo_id','start_date_todo','start_time_todo','end_time_do','hours_todo','min_todo','sec_todo' 
    ];

    
}
