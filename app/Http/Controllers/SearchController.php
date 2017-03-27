<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infocode;
use App\Facility;
use Auth;

class SearchController extends Controller
{
     public function __construct(){
        $this->middleware('auth'); 
     }

     public function index(){
    	$codes = Infocode::all(); 
    	$results = [];
        $user = Auth::user();


    	return view('search',compact('codes','results','user')); 

    }

    public function search(Request $request){

    	$items = $request->all(); 

    	$filters = $items['filter'];

    	$codes = Infocode::all();


    	$query = Facility::where('name','like','%' . $items['text'] . '%');

    	foreach($filters as $filter){
    		$query->where('codes','like','%' . $filter . '%');
    	}

    	$results = $query->get();

    	return view('search',compact('results','codes'));


    	//print_r($results);

    }
}
