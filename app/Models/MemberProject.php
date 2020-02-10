<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProject extends Model
{
	protected $table = 'member_project';

    $fillable = [
    	'member_id', 'project_id'
    ]; 

    public function members()
    {
    	$this->hasMany(Member::class);
    }

    public function projects()
    {
    	$this->hasMany(Project::class);
    }
}
