<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Auth;

class DataController extends Controller
{
    public function users(){	
    	$users = User::all();
    	return $users;

    }
}
