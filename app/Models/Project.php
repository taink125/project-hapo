<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name', 'description', 'start_time', 'end_time', 'status_id', 'leader_id', 'customer_id'
    ];

    public function scopeSearch($query, $request)
    {
        return $query->where('name', 'like', '%' . $request->keySearch . '%');
    }

    public function members()
    {
    	return $this->belongsToMany(Member::class, 'member_project')
            ->withTimestamps();
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function member_project()
    {
        return $this->belongsToMany(Member::class);
    }

    public function leader()
    {
        return $this->belongsTo(Member::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function getMemberIdsAttribute()
    {
        return $this->members->pluck('id')->toArray();
    }
}
