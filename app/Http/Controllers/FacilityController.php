<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;

class FacilityController extends Controller
{
    public function __construct(){

    }

    public function index(){

    }

    public function create(){

    }

    public function update(){
    	
    }

    public function add(Request $request){
    	//get the post values 
    	//echo "Hello";
    	$us_state_abbrevs = array(' AL ', ' AK ', ' AS ', ' AZ ', ' AR ', ' CA ', ' CO ', ' CT ', ' DE ', ' DC ', ' FM ', ' FL ' , ' GA ', ' GU ', ' HI ', ' ID ', ' IL ', ' IN ',  ' IA ', ' KS ', ' KY ', ' LA ', ' ME ', ' MH ', ' MD ', ' MA ', ' MI ', ' MN ', ' MS ', ' MO ', ' MT ', ' NE ', ' NV ', ' NH ', ' NJ ', ' NM ', ' NY ', ' NC ', ' ND ', ' MP ', ' OH ', ' OK ', ' OR ', ' PW ', ' PA ', ' PR ', ' RI ', ' SC ', ' SD ', ' TN ', ' TX ' , ' UT ', ' VT ', ' VI ', ' VA ', ' WA ', ' WV ', ' WI ', ' WY ', ' AE ', ' AA ', ' AP ');

		$ages = ['ADLT','CHLD','SNR','YAD'];

    	$value = $request->only('blob');
    	//let's just print out what's been sent
    	

    	$text = trim(htmlspecialchars($value['blob']));
    	//$text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');

    	//$text = iconv("UTF-8", "UTF-8//IGNORE", $text)
		$textAr = explode("\n", $text);
		$textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind

		$currentElement = "name"; 
		$nextElement = ""; 
		$firstCode = true;
		$object = []; 
		$x = 0; 

		foreach($textAr as $key => $value){

			
			if($currentElement == "name" && ctype_upper($value) == true){
				//this is a city name ignore it
				continue; 
			}

			if($currentElement == "name"){
				if(isset($object[$x]['name']) != false){
					//exists so let's add to it 
					$object[$x]['name'] .= $value;
				} else {
					$object[$x]['name'] = $value;
					$object[$x]['link'] = '';
					$object[$x]['zip'] ='';
				}

				

				if(is_numeric(substr($textAr[$key + 1], 0, 1))){
					//address coming up next 
					$currentElement = 'address';
					continue;
				} else {
					continue; 
				}
			}

			if($currentElement == "address"){
				$object[$x]['address'] = $value; 
				foreach($us_state_abbrevs as $state){
					if(strpos($textAr[$key+1], $state) == false ){
						//not found do nothing
						
						continue;
					} else {
						$currentElement = 'citystate';
						continue;
					}
				}
				continue;
				

			}

			if($currentElement == 'citystate') {
				$cs = explode(",", $value);
				$object[$x]['city'] = $cs[0];
				$object[$x]['state'] = substr($cs[1], 0, strrpos($cs[1], ' ')); 
				$currentElement = "phone"; 
				continue;
			}

			if($currentElement == 'phone') {
				$object[$x]['phone'] = $value; 
				$currentElement = "codes"; 
				continue;
			}

			if($currentElement == 'codes'){
				//let's check the value and see if it works
				$text = $this->convert_ascii($value);

				if(1 === preg_match('~[0-9]~', $text)){
					echo "Skip" . $text;
					echo "<br>"; 
					//
					continue;
				}

				$go = true; 

				if(isset($object[$x]['codes']) == false){
					$object[$x]['codes'] = $text;
				} else {
					$object[$x]['codes'] .= $text;
				}

				foreach($ages as $age){
					if(strpos($text, $age) !== false) {
						//ok we have an age let's check if the net row has one 
						$go = false; 
						if(array_key_exists($key+1, $textAr)){
							$ele = $this->convert_ascii($textAr[$key +1]);
							foreach($ages as $age){
								if(strpos($ele, $age) !== false) {
									//ok there is another age coming
									$go = true; 
								}
							}

						}
					}
				}

				if($go === false){
					$currentElement = "name";
					$x++; 
					continue; 
				}


				}

				//continue;

				
			}

		
		echo "End of loop";
		print_r("End of loop");

    	print_r($object);

    	//now create the records and return to the dashboard 
    	//
    	foreach($object as $facility){

    		$new = Facility::create($facility);

    	}

    	return redirect()->action('PagesController@home');
    
    }

    public function convert_ascii($string) 
    { 
  // Replace Single Curly Quotes
    	$search[]  = chr(226).chr(128).chr(152);
    	$replace[] = "'";
    	$search[]  = chr(226).chr(128).chr(153);
    	$replace[] = "'";
  // Replace Smart Double Curly Quotes
    	$search[]  = chr(226).chr(128).chr(156);
    	$replace[] = '"';
    	$search[]  = chr(226).chr(128).chr(157);
    	$replace[] = '"';
  // Replace En Dash
    	$search[]  = chr(226).chr(128).chr(147);
    	$replace[] = '--';
  // Replace Em Dash
    	$search[]  = chr(226).chr(128).chr(148);
    	$replace[] = '---';
  // Replace Bullet
    	$search[]  = chr(226).chr(128).chr(162);
    	$replace[] = '*';
  // Replace Middle Dot
    	$search[]  = chr(194).chr(183);
    	$replace[] = '*';
  // Replace Ellipsis with three consecutive dots
    	$search[]  = chr(226).chr(128).chr(166);
    	$replace[] = '...';
  // Apply Replacements
    	$string = str_replace($search, $replace, $string);
  // Remove any non-ASCII Characters
    	$string = preg_replace("/[^\x01-\x7F]/","", $string);
    	return $string; 
    }
}
