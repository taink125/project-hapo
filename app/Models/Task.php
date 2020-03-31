<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    	'name', 'description', 'start_time', 'end_time', 'status_id', 'member_id', 'project_id'
    ];

    public function scopeSearch($query, $request)
    {
        return $query->where('name', 'like', '%' . $request->keySearch . '%');
    }

    public function member()
    {
    	return $this->belongsTo(Member::class);
    }

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function status()
    {
    	return $this->hasOne(Status::class);
    }
}
