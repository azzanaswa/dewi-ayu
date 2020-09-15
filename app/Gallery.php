<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'content', 'image'];

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
