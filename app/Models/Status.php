<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    $fillable = [
    	'name', 'type'
    ];

    public function projects()
    {
    	return $this->belongsTo(Project::class);
    }

    public function tasks()
    {
    	return $this->belongsTo(Task::class);
    }
}
