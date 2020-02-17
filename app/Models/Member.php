<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    const IS_ADMIN = [
        0 => 'Admin',
        1 => 'User'
    ];

    public function scopeMember($query, $request)
    {
        return $query->where('name', 'like', '%' . $request->keySearch . '%')  
                ->orWhere('email', 'like', '%' . $request->keySearch . '%')
                ->orWhere('phone', 'like', '%' . $request->keySearch . '%')
                ->orWhere('id', 'like', '%' . $request->keySearch . '%');
    }

    protected $fillable = [
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

    public function leadingProjects()
    {
        return $this->hasMany(Project::class, 'foreign_key', 'leader_id');
    }

    public function getIsAdminLabelAttribute()
    {
        return self::IS_ADMIN[$this->is_admin];
    }
}
