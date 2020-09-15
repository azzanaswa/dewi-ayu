<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'password'];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
}
