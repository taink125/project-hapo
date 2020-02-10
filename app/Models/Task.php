<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    $fillable = [
    	'name', 'description', 'start_time', 'end_time', 'status_id', 'member_id', 'project_id'
    ];

    public function members()
    {
    	return $this->belongsTo(Member::class);
    }

    public function projects()
    {
    	return $this->belongsTo(Project::class);
    }

    public function status()
    {
    	return $this->hasOne(Status::class);
    }
}
