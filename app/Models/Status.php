<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
    	'name', 'type'
    ];

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }
}
