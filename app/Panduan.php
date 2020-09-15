<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
    protected $fillable = ['title', 'file', 'user_id'];

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
