<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{

	protected $fillable = ['name', 'created_at', 'updated_at',  ]

    public function user(){
    	return $this->belongsToMany('App\User'); 
    }

    public function facilities(){
    	return $this->belongsToMany('App\Facility');
    }
}
