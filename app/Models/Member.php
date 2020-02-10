<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    $fillable = [
    	'name', 'email', 'phone', 'image', 'password', 'address', 'is_admin'
    ];

    public function projects()
    {
    	return $this->belongsToMany(Project::class, 'member_project');
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function member_project()
    {
    	return $this->belongsTo(MemberProject::class);
    }
}
