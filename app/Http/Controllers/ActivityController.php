<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use App\Activity; 
use App\Mail\ActivityAssigned; 

class ActivityController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function create(Request $request){
    	$data = $request->all(); 
    	$user = Auth::user();
    	$data['activity']['creator_id'] = $user->id;
    	$data['activity']['type'] = 'followup';
    	$data['activity']['assigned_type'] = 'user';


    	$activity = Activity::create($data['activity']);
    	$activity->load('creator','assigned','facility');

    	\Mail::to($activity->assigned->email)->send(new ActivityAssigned($activity));

    	//notify the assigned user
    	return ['message' => 'success'];
    }

    public function update($id, Request $request) {
    	$activity = Activity::find($id); 
    	$data = $request->all(); 
    	$activity->update($data);
    	return ['message' => 'success']; 
    }

    public function getList(){
    	$user = Auth::user(); 
    	$assigned = Activity::where('assigned_id', $user->id)->where('status', 'open')->get(); 
    	$created = Activity::where('creator_id', $user->id)->where('status','open')->get(); 
    	$completed = Activity::where('assigned_id', $user->id)->orWhere('creator_id', $user->id)->where('status','complete')->get();
    	return ['assigned' => $assigned, 'created' => $created, 'completed' => $compelted];

    }

    public function complete($id){	
    	$user = Auth::user(); 
    	$activity = Activity::find($id);
    	if($activity->assigned_id == $user->id){
    		$activity->status = 'complete';
    		$activity->save(); 
    		//notify the creator
 			$response = ["message" => "success"];
    	} else {
    		$response = ["message" => "error", "description" => "Permissions Problem"]; 
    	}	

    	return $response;
    }

    public function dashboard(){
    	$user = Auth::user(); 
    	$assigned = Activity::where('assigned_id', $user->id)->where('status','open')->with('facility')->get(); 
    	$created = Activity::where('creator_id', $user->id)->with('assigned')->get(); 
    	$completed = Activity::where('assigned_id', $user->id)->orWhere('creator_id', $user->id)->where('status','complete')->get();

    	return view('activitydash', compact('user','assigned','created','completed'));

    }

    public function details($id){


    }
}
