<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    $fillable = [
    	'name', 'description', 'start_time', 'end_time', 'status_id', 'leader_id', 'customer_id'
    ];

    public function members()
    {
    	return $this->belongsToMany(Member::class, 'member_project');
    }

    public function member_project()
    {
    	return $this->belongsTo(MemberProject::class)
    }

    public function customers()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function statuses()
    {
    	return $this->hasOne(Status::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }
}
