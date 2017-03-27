<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title','content','due_date','reminder', 'type','creator_id','assigned_id','assigned_type','facility_id'];

    public function notes(){
    	return $this->belongsToMany('App\Note'); 
    } 

    public function creator(){
    	return $this->belongsTo('App\User','creator_id');
    }

    public function assigned(){
    	return $this->belongsTo('App\User','assigned_id');
    }

    public function facility(){
    	return $this->belongsTo('App\Facility', 'facility_id');
    }




}
