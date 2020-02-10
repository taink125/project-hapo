<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    	'name', 'phone', 'image', 'email', 'address'
    ];

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }
}
