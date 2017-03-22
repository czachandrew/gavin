<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
   protected $fillable = ['name', 'link','address','city','state','phone','codes','zip'];
    //
    public function contact(){
    	return $this->hasOne('App\Contact');
    }

    public function notes(){
    	return $this->hasMany('App\Note');
    }

    public function calls(){
    	return $this->hasMany('App\Call');
    }
}
