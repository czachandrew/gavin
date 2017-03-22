<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{	
	protected $fillable = ['user_id','facility_id','call_id','body'];

    public function user(){
    	return $this->belongsTo('App\User'); 
    }

    public function facility(){
    	return $this->belongsTo('App\Facility');
    }
}
