<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class Member extends Authenticatable
{
    const IS_ADMIN = [
        0 => 'Admin',
        1 => 'User'
    ];

    public function scopeSearch($query, $request)
    {
        return $query->searchName($request)
            ->searchEmail($request)
            ->searchPhone($request);
    }

    public function scopeSearchName($query, $request)
    {
        return $query->where('name', 'like', '%' . $request->keySearch . '%');
    }

    public function scopeSearchEmail($query, $request)
    {
        return $query->orWhere('email', 'like', '%' . $request->keySearch . '%');
    }

    public function scopeSearchPhone($query, $request)
    {
        return $query->orWhere('phone', 'like', '%' . $request->keySearch . '%');
    }

    public function scopeSearchRole($query, $request)
    {
        if (!empty($request->searchPermission)) {
            return $query->where('is_admin', $request->searchPermission);
        }
    }

    protected $fillable = [
    	'name', 'email', 'phone', 'image', 'password', 'address', 'is_admin'
    ];

    public function projects()
    {
    	return $this->belongsToMany(Project::class, 'member_project')
            ->withTimestamps();
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function leadingProjects()
    {
        return $this->hasMany(Project::class, 'leader_id');
    }

    public function getIsAdminLabelAttribute()
    {
        return self::IS_ADMIN[$this->is_admin];
    }
}
