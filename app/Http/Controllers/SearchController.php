<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infocode;
use App\Facility;

class SearchController extends Controller
{
     public function __construct(){

     }

     public function index(){
    	$codes = Infocode::all(); 
    	$results = [];

    	return view('search',compact('codes','results')); 

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
