<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //
    protected $fillable = ['message','status','user_id', 'facility_id'];

    public function facility(){
    	return $this->belongsTo('App\Facility');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
