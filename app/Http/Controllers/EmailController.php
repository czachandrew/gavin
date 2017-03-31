<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
//use GuzzleHttp;

class EmailController extends Controller
{
    public function send(){
    	$data['name'] = "Person";
    	Mail::send('emails.test', $data, function($message) {
    		$message->to('andy@hftoptics.com')->subject('Hello there');
    	});
    }
}
