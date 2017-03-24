<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notepad extends Model
{
    protected $fillable = ['content', 'last_update', 'update_at', 'created_at'];

    public function lastupdate(){
    	return $this->belongsTo('App\User', 'last_update');
    }
}
