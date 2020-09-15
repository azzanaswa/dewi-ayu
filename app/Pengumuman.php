<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ['title', 'image', 'content', 'file'];

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
