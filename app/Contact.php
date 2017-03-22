<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'phone','email','facility_id'];
    //
    public function facility(){
    	return $this->belongsTo('App\Facility');
    }
}
