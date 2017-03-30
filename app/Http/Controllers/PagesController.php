<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\Note;
use App\Contact; 
use App\Call;
use App\Notepad;
use App\Activity;
use Auth; 
use Log;

class PagesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');

    }

    public function home(){
    	//get all uncalled facilities 
    	$facilities = Facility::where('possible','!=','no')->with('calls')->get();
        $notepad = Notepad::with('lastupdate')->first(); 
        $user = Auth::user();
        if($notepad == null){
            $notepad = Notepad::create();
        }

    	return view('home', compact('facilities','notepad','user'));
    	//get all contacted not called facilities 
    }

    public function possible(){
        $facilities = Facility::where('possible', 'yes')->orWhere('possible','maybe')->get();

        $user = Auth::user();

        $notepad = Notepad::with('lastupdate')->first();


        return view('home', compact('facilities','notepad','user'));
    }

    public function markIt($id, Request $request){
    	//print_r($request->all());
    	$values = $request->all(); 
    	$facility = Facility::where('id', $id)->first(); 


    	if($values['potential'] == 'yes'){
    		$facility->possible = 'yes';
    	} elseif($values['potential'] == 'no') {
    		$facility->possible = 'no'; 
    	} elseif($values['potential'] == 'maybe') {
    		$facility->possible = 'maybe';
    	}

    	$facility->save(); 

    	return redirect()->action('PagesController@view', ['id' => $id]);
    }

    public function view($id, $call = 'no'){
    	$facility = Facility::with('notes','contact')->where('id', $id)->first(); 

        $activities = Activity::with('assigned')->where('facility_id', $id)->where('status', 'open')->get();
        //$activities = [];

    	$user = Auth::user();

    	if($call == 'call'){
    		//create a call 
    		//
    		$call = Call::create(['user_id' => $user->id, 'message' => $user->name . ' called ' . $facility->name, 'status' => 'attempt', 'facility_id' => $facility->id]);
    		Note::create(['user_id' => $user->id, 'facility_id' => $facility->id, 'body' => $call->message, 'call_id' => $call->id]);

    		return redirect()->action('PagesController@view', ['id' => $id]);
    	}



    	
    	$notes = Note::with('user')->where('facility_id', $id)->orderBy('created_at', 'desc')->get();

    	$contact = $facility->contact;



    	return view('facility', compact('facility','notes','contact','user','activities')); 
    }

    public function addContact($id, Request $request) {
    	$post = $request->all(); 

    	$contact = Contact::create(['name' => $post['name'], 'phone' => $post['phone'], 'email' => $post['email'], 'facility_id' => $id]);

    	//redirect to home route 
    	return redirect()->action('PagesController@view', ['id' => $id]);
    }

    public function addNote($id, Request $request){
    	$post = $request->only('body');

        $user = Auth::user();
    	//print_r($post);
    	//Log::info($post);
    	//check and make sure the note hasn't already been created 
    	$check = Note::where('body', $post['body'])->first(); 

         $activities = Activity::with('assigned')->where('facility_id', $id)->where('status', 'open')->get();

    	if(!$check){
    		$note = Note::create(['user_id' => $user->id, 'facility_id' => $id, 'body' => $post['body']]);
    	} else {
    		//do nothing
    	}

    	

    	$facility = Facility::with('notes','contact')->where('id', $id)->first();

    	$contact = $facility->contact;

    	$notes = Note::where('facility_id', $id)->orderBy('created_at','desc')->get();

    	return view('facility', compact('facility','notes','contact', 'activities', 'user')); 

    }

    public function admin(){
    	//get all facilities
    }

}
