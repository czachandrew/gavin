<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notepad;
use Auth;

class NotepadController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

    public function update(Request $request, $id){
    	$data = $request->all();
    	//print_r($data);
    	$user = Auth::user(); 
    	$notepad = Notepad::where('id', $id)->first(); 
    	$notepad->content = $data['content'];
    	$notepad->last_update = $user->id;
    	$notepad->save(); 
    	return ['message' => 'success'];

    }
}
