<?php namespace Expedia\ExpediaImport\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Log;
use Db;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;
use Storage;
use Expedia\Api\Models\Settings;



class Regions extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Expedia.ExpediaImport', 'main-menu-expedia-import', 'side-menu-region');
    }



    public function create_onImportRegions() {

    	// get region id entered
    	$id = Input::get('txtregionid');
    	//$api_key = Settings::instance()->api_key;


    	

    	if(!empty($id) && is_numeric($id)) {

    		// do the importing or regions here
    		$withLink = 1;
    		$firstcall = 1;
    		$ctr = 1;


    		while($withLink > 0) {
    			$myurl = "";

		    	// API Settings from backend
		        $apiKey = Settings::instance()->api_key;
		        $secret = Settings::instance()->secret_key;
		        $timestamp = time();
		        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();

		       // \Flash::success('Region ID:'.  $secret);

		        // Initialize API connection
		        $ch = curl_init();

		        if ($firstcall > 0) {

		        	$myurl = "https://test.ean.com/2.4/regions?ancestor_id=".$id."&language=en-US&include=details&include=property_ids&include=property_ids_expanded";

		    	} else {

		    		$prev_token = $newtoken;

		    		$myurl = "https://test.ean.com/2.4/regions?ancestor_id=".$id."&language=en-US&include=details&include=property_ids&include=property_ids_expanded&".$prev_token;
		    		//$newtoken = "";
		    		 // \Log::info('Pre'.$prev_token);

		    	}


		        // make the call to get Headers 
		        $headers = [];
		        $link = [];
		        $token = [];

		        curl_setopt($ch, CURLOPT_URL, $myurl);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_USERAGENT, "PostmanRuntime/7.26.1");
		        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            $authHeader,
		            "Customer-Ip: 5.5.5.5",
		            "Accept: application/json",
		            "Accept-Encoding: gzip"
		          ));

		        // this function is called by curl for each header received
				curl_setopt($ch, CURLOPT_HEADERFUNCTION,
				  function($curl, $header) use (&$headers)
				  {
				    $len = strlen($header);
				    $header = explode(':', $header, 2);
				    if (count($header) < 2) // ignore invalid headers
				      return $len;

				    $headers[strtolower(trim($header[0]))][] = trim($header[1]);

				    return $len;
				  });

		        // get response
		        $respond = curl_exec($ch);

		        // get link header if response will be paginated 
		        $link = !empty($headers['link'][0]) ? $headers['link'][0] : "";

		        //check if Link is present 

		        if(!empty($link)) {

		        	$withLink = 1;
		        	$newtoken = "";

		        	// get token 
		        	preg_match('/<(.*?)>/', $link, $token);
					$newtoken =  str_replace('https://test.ean.com/2.4/regions?', '', $token[1]);
					$firstcall = 0;

					// Log::info('New'.$newtoken);


		        } else {

		        	$withLink = 0;
		        	$firstcall = 0;

		        	Log::info('No page link, possible last page for region selected. ');
		        }


		        // call it for Body

		        curl_setopt_array($ch, array(
		          CURLOPT_URL => $myurl,
		          CURLOPT_RETURNTRANSFER => true,
		          CURLOPT_USERAGENT => "PostmanRuntime/7.26.1",
		          CURLOPT_ENCODING => "",
		          CURLOPT_MAXREDIRS => 10,
		          CURLOPT_TIMEOUT => 0,
		          CURLOPT_FOLLOWLOCATION => true,
		          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		          CURLOPT_CUSTOMREQUEST => "GET",
		          CURLOPT_HTTPHEADER => array(
		            $authHeader,
		            "Customer-Ip: 5.5.5.5",
		            "Accept: application/json",
		            "Accept-Encoding: gzip"
		          ),
		        ));

		        // get response
		        $response = curl_exec($ch);

		        curl_close($ch);



		        // converts them to array
		        $results = json_decode($response);


		        //$headers = get_headers($myurl, 1);

				//\trace_log($headers);

				//list($headers, $content) = explode("\r\n\r\n",$response,2);
		        //$header_arrays = array();

		        // Print header
				//foreach (explode("\r\n",$headers) as $hdr)
	    			//printf('<p>Header: %s</p>', $hdr);
	    		//	$header_arrays[] = $hdr;

	    		//\trace_log($headers);



		        // check array if not empty and get array values

		            if (!empty($results)) {

		            	// put them to array 
		            	foreach ($results as $key => $value) { 
		                    $newresult = $value; 


		                     if (isset($newresult)) {

			                    $region_id = $newresult->id;
				                $region_type = $newresult->type;
				                $region_name = $newresult->name;
				                $region_full_name = $newresult->name_full;
				                $country_code = $newresult->country_code;
				                $descriptor = !empty($newresult->descriptor) ? $newresult->descriptor : "";
				                $longitude = $newresult->coordinates->center_longitude;
				                $latitude = $newresult->coordinates->center_latitude;

				                 //point of interest
				                if(!empty($newresult->associations->point_of_interest)) {
				                    $poi = $newresult->associations->point_of_interest;
				                    // iterate thru theme array 
				                    $point_of_interest = array();
				                    foreach($poi as $key => $values) {
				                        $point_of_interest[] = $values;
				                    }

				                    $point_of_interest = serialize($point_of_interest);

				                } else {
				                    //$themes = "";
				                    $point_of_interest = "";
				                }


				                //Anc3stors
				                if(!empty($newresult->ancestors)) {
				                    $ans = $newresult->ancestors;
				                    // iterate thru theme array 
				                    $ancestors = array();
				                    foreach($ans as $key => $values) {
				                        $ancestors[] = $values;
				                    }

				                    $ancestors = serialize($ancestors);

				                } else {
				                    //$themes = "";
				                    $ancestors = "";
				                }

				                 //Descendants
				                if(!empty($newresult->descendants)) {
				                    $desc = $newresult->descendants;
				                    // iterate thru theme array 
				                    $descendants = array();
				                    foreach($desc as $key => $values) {
				                        $descendants[] = $values;
				                    }

				                    $descendants = serialize($descendants);

				                } else {
				                    //$themes = "";
				                    $descendants = "";
				                }


				                //property id
				                if(!empty($newresult->property_ids)) {
				                    $pro_ids = $newresult->property_ids;
				                    // iterate thru theme array
				                    $property_ids = array(); 
				                    foreach($pro_ids as $key => $values) {
				                        $property_ids[] = $values;
				                    }

				                    $property_ids = serialize($property_ids);

				                } else {
				                    //$themes = "";
				                    $property_ids = "";
				                } 



				                //property expanded
				                if(!empty($newresult->property_ids_expanded)) {
				                    $pro_exp = $newresult->property_ids_expanded;
				                    // iterate thru theme array 
				                    $property_ids_expanded = array(); 
				                    foreach($pro_exp as $key => $values) {
				                        $property_ids_expanded[] = $values;
				                    }

				                    $property_ids_expanded = serialize($property_ids_expanded);

				                } else {
				                    //$themes = "";
				                    $property_ids_expanded = "";
			                	}


			                	// INSERT TO TABLE
				            	$updated_date = date('Y-m-d H:i:s');


					            	$duplicate = Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->first();

						            if(!empty($duplicate)) {

						                if ($duplicate->region_id == $region_id) {
						                    
						                  // update property ids under region only 
						                    Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->update([
						                    	'updated_at' => $updated_date,
						                        'region_id' => $region_id, 
						                        // Initialize vars for ratings
						                        'region_type' => $region_type,
						                        'region_name' => $region_name,
						                        'region_name_full' => $region_full_name,
						                        'country_code' => $country_code,
						                        'descriptor' => $descriptor,
						                        'longitude' => $longitude,
						                        'latitude' => $latitude,
						                        'point_of_interest' => $point_of_interest,
						                        'ancestors' => $ancestors,
						                        'descendants' => $descendants,
						                        'property_ids' => $property_ids,
						                        'property_ids_expanded' => $property_ids_expanded	                       
						                     ]);

						                } 

						            } else {

						            	// Add Region   
						            	 Db::table('expedia_expediaimport_regions')->insert([
				                    	'updated_at' => $updated_date,
				                        'region_id' => $region_id, 
				                        // Initialize vars for ratings
				                        'region_type' => $region_type,
				                        'region_name' => $region_name,
				                        'region_name_full' => $region_full_name,
				                        'country_code' => $country_code,
				                        'descriptor' => $descriptor,
				                        'longitude' => $longitude,
				                        'latitude' => $latitude,
				                        'point_of_interest' => $point_of_interest,
				                        'ancestors' => $ancestors,
				                        'descendants' => $descendants,
				                        'property_ids' => $property_ids,
				                        'property_ids_expanded' => $property_ids_expanded	                       
				                     	]);


						            }


				                   

				            } else {

				            	\Log::info('End of records.');

				            } // endif empty results


		                } // end FOR EACH 


		                //\Flash::success('Region found ok');
		                \Log::info('Batch ' .$ctr. ' - regions imported');
		                $ctr++;

		                // Lets put a delay
			             if(sleep(10)!=0)
						 {
						    //\Log::useFiles('storage/logs/update.log');
						    \Log::error("Delay Error");
						    break;
						 } else {
						 	//\Log::useFiles('storage/logs/update.log');
						 	\Log::info("Waiting for 10 Seconds. Updating Regions");
						 }
		   

		            } else {
		                        
		                \Flash::error('Region Not Found');
		                $withLink = 0;
		                break;

		            }

            

            } // END WHILE 

            \Log::info('Done importing regions.');
            \Flash::success('Done importing regions');

    	} else {


    		\Flash::error('Try to enter a valid Region ID');

    	}





    } // end of import regions



    public function create_onUpdateRegions() {

    		// get region id entered
    		$id = Input::get('txtregionid');

    		if(!empty($id) && is_numeric($id)) {

    		// do the importing or regions here
    		$withLink = 1;
    		$firstcall = 1;
    		$ctr = 1;


    		while($withLink > 0) {
    			$myurl = "";

		    	// API Settings from backend
		        $apiKey = Settings::instance()->api_key;
		        $secret = Settings::instance()->secret_key;
		        $timestamp = time();
		        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();

		       // \Flash::success('Region ID:'.  $secret);

		        // Initialize API connection
		        $ch = curl_init();

		        if ($firstcall > 0) {

		        	$myurl = "https://test.ean.com/2.4/regions?ancestor_id=".$id."&language=en-US&include=property_ids&include=property_ids_expanded";

		    	} else {

		    		$prev_token = $newtoken;

		    		$myurl = "https://test.ean.com/2.4/regions?ancestor_id=".$id."&language=en-US&include=property_ids&include=property_ids_expanded&".$prev_token;
		    		//$newtoken = "";
		    		 // \Log::info('Pre'.$prev_token);

		    	}


		        // make the call to get Headers 
		        $headers = [];
		        $link = [];
		        $token = [];

		        curl_setopt($ch, CURLOPT_URL, $myurl);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_USERAGENT, "PostmanRuntime/7.26.1");
		        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            $authHeader,
		            "Customer-Ip: 5.5.5.5",
		            "Accept: application/json",
		            "Accept-Encoding: gzip"
		          ));

		        // this function is called by curl for each header received
				curl_setopt($ch, CURLOPT_HEADERFUNCTION,
				  function($curl, $header) use (&$headers)
				  {
				    $len = strlen($header);
				    $header = explode(':', $header, 2);
				    if (count($header) < 2) // ignore invalid headers
				      return $len;

				    $headers[strtolower(trim($header[0]))][] = trim($header[1]);

				    return $len;
				  });

		        // get response
		        $respond = curl_exec($ch);

		        // get link header if response will be paginated 
		        $link = !empty($headers['link'][0]) ? $headers['link'][0] : "";

		        //check if Link is present 

		        if(!empty($link)) {

		        	$withLink = 1;
		        	$newtoken = "";

		        	// get token 
		        	preg_match('/<(.*?)>/', $link, $token);
					$newtoken =  str_replace('https://test.ean.com/2.4/regions?', '', $token[1]);
					$firstcall = 0;

					// Log::info('New'.$newtoken);


		        } else {

		        	$withLink = 0;
		        	$firstcall = 0;

		        	Log::info('No page link, possible last page for region selected. ');
		        }


		        // call it for Body

		        curl_setopt_array($ch, array(
		          CURLOPT_URL => $myurl,
		          CURLOPT_RETURNTRANSFER => true,
		          CURLOPT_USERAGENT => "PostmanRuntime/7.26.1",
		          CURLOPT_ENCODING => "",
		          CURLOPT_MAXREDIRS => 10,
		          CURLOPT_TIMEOUT => 0,
		          CURLOPT_FOLLOWLOCATION => true,
		          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		          CURLOPT_CUSTOMREQUEST => "GET",
		          CURLOPT_HTTPHEADER => array(
		            $authHeader,
		            "Customer-Ip: 5.5.5.5",
		            "Accept: application/json",
		            "Accept-Encoding: gzip"
		          ),
		        ));

		        // get response
		        $response = curl_exec($ch);

		        curl_close($ch);



		        // converts them to array
		        $results = json_decode($response);


		        // check array if not empty and get array values

		            if (!empty($results)) {

		            	$rows_updated = 0;

		            	// put them to array 
		            	foreach ($results as $key => $value) { 
		                    $newresult = $value; 


		                     if (isset($newresult)) {

			                    $region_id = $newresult->id;

				                //property id
				                if(!empty($newresult->property_ids)) {
				                    $pro_ids = $newresult->property_ids;
				                    // iterate thru theme array
				                    $property_ids = array(); 
				                    foreach($pro_ids as $key => $values) {
				                        $property_ids[] = $values;
				                    }

				                    $property_ids = serialize($property_ids);

				                } else {
				                    //$themes = "";
				                    $property_ids = "";
				                } 



				                //property expanded
				                if(!empty($newresult->property_ids_expanded)) {
				                    $pro_exp = $newresult->property_ids_expanded;
				                    // iterate thru theme array 
				                    $property_ids_expanded = array(); 
				                    foreach($pro_exp as $key => $values) {
				                        $property_ids_expanded[] = $values;
				                    }

				                    $property_ids_expanded = serialize($property_ids_expanded);

				                } else {
				                    //$themes = "";
				                    $property_ids_expanded = "";
			                	}


			                	// INSERT TO TABLE
				            	$updated_date = date('Y-m-d H:i:s');

				                    $affected = Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->update([
				                    	'updated_at' => $updated_date,
				                        //'region_id' => $region_id, 
				                        'property_ids' => $property_ids,
				                        'property_ids_expanded' => $property_ids_expanded	                       
				                     ]);

				                    if($affected > 0) {

				                    	$rows_updated++;
				                    } 

				            } else {

				            	\Log::info('End of records.');

				            } // endif empty results


		                } // end FOR EACH 


		                //\Flash::success('Region found ok');
		                \Log::info('Batch ' .$ctr. ' - properties Updated - '.$rows_updated);
		                $rows_updated = 0;
		                $ctr++;

		                // Lets put a delay
			             if(sleep(10)!=0)
						 {
						    //\Log::useFiles('storage/logs/update.log');
						    \Log::error("Delay Error");
						    break;
						 } else {
						 	//\Log::useFiles('storage/logs/update.log');
						 	\Log::info("Waiting for 10 Seconds. Updating Regions");
						 }
		   

		            } else {
		                        
		                \Flash::error('Region Not Found');
		                $withLink = 0;
		                break;

		            }

            

            } // END WHILE 

            \Log::info('Done updating regions.');
            \Flash::success('Done updating regions');

    	} else {


    		\Flash::error('Try to enter a valid Region ID');

    	}


    }

        public function create_onImportSRegion() {

    	// get region id entered
    	$id = Input::get('txtsregionid');

    

    	// API Settings from backend
        $apiKey = Settings::instance()->api_key;
        $secret = Settings::instance()->secret_key;
        $timestamp = time();
        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();

         // Initialize API connection
        $ch = curl_init();

        $myurl = "https://test.ean.com/2.4/regions/".$id."?language=en-US&include=details&include=property_ids&include=property_ids_expanded";

        // make the call to get Headers 
        $headers = [];
        $link = [];
        $token = [];

		curl_setopt($ch, CURLOPT_URL, $myurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "PostmanRuntime/7.26.1");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            $authHeader,
            "Customer-Ip: 5.5.5.5",
            "Accept: application/json",
            "Accept-Encoding: gzip"
          ));  


        // this function is called by curl for each header received
		curl_setopt($ch, CURLOPT_HEADERFUNCTION,
		  function($curl, $header) use (&$headers)
		  {
		    $len = strlen($header);
		    $header = explode(':', $header, 2);
		    if (count($header) < 2) // ignore invalid headers
		      return $len;

		    $headers[strtolower(trim($header[0]))][] = trim($header[1]);

		    return $len;
		  });

		// get response
		        $respond = curl_exec($ch);

		        // get link header if response will be paginated 
		        $link = !empty($headers['link'][0]) ? $headers['link'][0] : "";

		        //check if Link is present 

		        if(!empty($link)) {

		        	$withLink = 1;
		        	$newtoken = "";

		        	// get token 
		        	preg_match('/<(.*?)>/', $link, $token);
					$newtoken =  str_replace('https://test.ean.com/2.4/regions?', '', $token[1]);
					$firstcall = 0;

					// Log::info('New'.$newtoken);


		        } else {

		        	$withLink = 0;
		        	$firstcall = 0;

		        	Log::info('No page link, possible last page for region selected. ');
		        }


		        // call it for Body

		        curl_setopt_array($ch, array(
		          CURLOPT_URL => $myurl,
		          CURLOPT_RETURNTRANSFER => true,
		          CURLOPT_USERAGENT => "PostmanRuntime/7.26.1",
		          CURLOPT_ENCODING => "",
		          CURLOPT_MAXREDIRS => 10,
		          CURLOPT_TIMEOUT => 0,
		          CURLOPT_FOLLOWLOCATION => true,
		          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		          CURLOPT_CUSTOMREQUEST => "GET",
		          CURLOPT_HTTPHEADER => array(
		            $authHeader,
		            "Customer-Ip: 5.5.5.5",
		            "Accept: application/json",
		            "Accept-Encoding: gzip"
		          ),
		        ));



        // get response
        $response = curl_exec($ch);
        curl_close($ch);


        // converts them to array
        $results = json_decode($response);

        //print_r($results);


        if (!empty($results)) {

        	//$newresult =  array();
        	// put them to array 
        	foreach ($results as $key => $value) { 
                $newresult[] = $value; 
            } // end FOR EACH 

            \Log::info($newresult);

                if (isset($newresult)) {

                    $region_id = $newresult[0];
	                $region_type = $newresult[1];
	                $region_name = $newresult[2];
	                $region_full_name = $newresult[3];
	                $country_code = $newresult[4];
	                //$descriptor = !empty($newresult->descriptor) ? $newresult->descriptor : "";
	                $longitude = $newresult[5]->center_longitude;
	                $latitude = $newresult[5]->center_latitude;

	                 //point of interest
	                if(!empty($newresult[7]->point_of_interest)) {
	                    $poi = $newresult[7]->point_of_interest;
	                    // iterate thru theme array 
	                    $point_of_interest = array();
	                    foreach($poi as $key => $values) {
	                        $point_of_interest[] = $values;
	                    }

	                    $point_of_interest = serialize($poi);

	                } else {
	                    //$themes = "";
	                    $point_of_interest = "";
	                }


	                //Anc3stors
	                if(!empty($newresult[6])) {
	                    $ans = $newresult[6];
	                    // iterate thru theme array 
	                    $ancestors = array();
	                    foreach($ans as $key => $values) {
	                        $ancestors[] = $values;
	                    }

	                    $ancestors = serialize($ancestors);

	                } else {
	                    //$themes = "";
	                    $ancestors = "";
	                }

	                 //Descendants
	                if(!empty($newresult[7])) {
	                    $desc = $newresult[7];
	                    // iterate thru theme array 
	                    $descendants = array();
	                    foreach($desc as $key => $values) {
	                        $descendants[] = $values;
	                    }

	                    $descendants = serialize($descendants);

	                } else {
	                    //$themes = "";
	                    $descendants = "";
	                }


	                //property id
	                if(!empty($newresult[8])) {
	                    $pro_ids = $newresult[8];
	                    // iterate thru theme array
	                    $property_ids = array(); 
	                    foreach($pro_ids as $key => $values) {
	                        $property_ids[] = $values;
	                    }

	                    $property_ids = serialize($property_ids);

	                } else {
	                    //$themes = "";
	                    $property_ids = "";
	                } 



	                //property expanded
	                if(!empty($newresult[9])) {
	                    $pro_exp = $newresult[9];
	                    // iterate thru theme array 
	                    $property_ids_expanded = array(); 
	                    foreach($pro_exp as $key => $values) {
	                        $property_ids_expanded[] = $values;
	                    }

	                    $property_ids_expanded = serialize($property_ids_expanded);

	                } else {
	                    //$themes = "";
	                    $property_ids_expanded = "";
                	}


                	// INSERT TO TABLE
	            	$updated_date = date('Y-m-d H:i:s');


		            	$duplicate = Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->first();

			            if(!empty($duplicate)) {

			                if ($duplicate->region_id == $region_id) {
			                    
			                  // update property ids under region only 
			                    Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->update([
			                    	'updated_at' => $updated_date,
			                        'region_id' => $region_id, 
			                        // Initialize vars for ratings
			                        'region_type' => $region_type,
			                        'region_name' => $region_name,
			                        'region_name_full' => $region_full_name,
			                        'country_code' => $country_code,
			                        //'descriptor' => $descriptor,
			                        'longitude' => $longitude,
			                        'latitude' => $latitude,
			                        'point_of_interest' => $point_of_interest,
			                        'ancestors' => $ancestors,
			                        'descendants' => $descendants,
			                        'property_ids' => $property_ids,
			                        'property_ids_expanded' => $property_ids_expanded	                       
			                     ]);

			                } 

			                \Flash::success('Region Updated');
            				\Log::info('Region Updated');

			            } else {

			            	// Add Region   
			            	 Db::table('expedia_expediaimport_regions')->insert([
	                    	'updated_at' => $updated_date,
	                        'region_id' => $region_id, 
	                        // Initialize vars for ratings
	                        'region_type' => $region_type,
	                        'region_name' => $region_name,
	                        'region_name_full' => $region_full_name,
	                        'country_code' => $country_code,
	                        //'descriptor' => $descriptor,
	                        'longitude' => $longitude,
	                        'latitude' => $latitude,
	                        'point_of_interest' => $point_of_interest,
	                        'ancestors' => $ancestors,
	                        'descendants' => $descendants,
	                        'property_ids' => $property_ids,
	                        'property_ids_expanded' => $property_ids_expanded	                       
	                     	]);
			           	
			           		\Flash::success('Region Added');
            				\Log::info('New region added');


			            }


	                   

	            } else {

	            	\Log::info('End of records.');

	            } // endif empty results


            


          /*  \Flash::success('Region Added');
            \Log::info('New region added'); */
            //$ctr++;
	        
            

        } else {
                    
            \Flash::error('Region Not Found'. $myurl);

            \Log::info($results);
            //$withLink = 0;
            //break;

        }


        } // end funcion create_onImportSRegion()

}
