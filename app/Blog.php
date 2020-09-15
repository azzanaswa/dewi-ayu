<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $fillable = ['title', 'image', 'content'];

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }
}
