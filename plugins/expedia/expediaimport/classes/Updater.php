<?php 

namespace Expedia\ExpediaImport\Classes;

use App;
use Lang;
use Flash;
use Db;
use Model;
use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Storage;
use Expedia\ExpediaImport\Models\Regionpids;

// Region Auto Updater 
class Updater {

	public static function checkTest() {
		$pids = Db::table('expedia_expediaimport_properties')->select('property_id')->get();

		$array_pids = [];

		foreach($pids as $ikey => $ivalue) {
			$array_pids[] = $ivalue->property_id;
		}
		//\Log::info($array_pids);
		\trace_log($array_pids);


	}


	public static function checkRegions() {

		// get all country region ids
		$country_ids = Db::table('expedia_expediaimport_regions')->where('region_type', '=', 'country')->get();


		foreach($country_ids as $ckey => $cvalue) {
			$array_regions[] = $cvalue->region_id;
		}



		// 11184 - queensland, 11200 - tasmania
		//$array_regions = array('6023180');

		//$id = 11184; // Region ID for Australia 

		// truncate region property ids table 
		Db::table('expedia_expediaimport_region_pids')->truncate();

		\Log::info('Auto updating property ids under regions.');

		// initialize region id from arrays 
		foreach($array_regions as $rid_value) {

			$id = $rid_value;
				// get all property ID's in the database for comparing

				$pids = Db::table('expedia_expediaimport_properties')->select('property_id')->get();

				$array_pids = [];

					foreach($pids as $ikey => $ivalue) {
						$array_pids[] = $ivalue->property_id;
					}



				
				if(!empty($id)) {


					// do the importing or regions here
		    		$withLink = 1;
		    		$firstcall = 1;
		    		$ctr = 1;


		    		while($withLink > 0) {

		    			$myurl = "";

				    	// API Settings from backend
				        //$apiKey = Settings::instance()->api_key;
				        //$secret = Settings::instance()->secret_key;
				        //$timestamp = time();

				        // API Settings from backend
		                $apiKey = "1d99ilkinggvercocq9u21ki1p";
		                $secret = "bep3s64f1ou57";
		                $timestamp = time();
				        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();




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

					        	\Log::info('No page link, possible last page for region selected. ');
					        }



					        // call it for body response

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
				            	$newresult = [];

				            	// put them to array 
				            	foreach ($results as $key => $value) { 
				                    $newresult = $value; 


				                     if (isset($newresult)) {

					                    $region_id = $newresult->id;
					                    //$deletedRows = Regionpids::where('region_id', $region_id)->delete();
					                    //Db::table('expedia_expediaimport_region_pids')->where('region_id', '=', $region_id)->delete();

						                //property id
						                if(!empty($newresult->property_ids)) {
						                    $pro_ids = $newresult->property_ids;
						                    // iterate thru theme array
						                    $property_ids = array(); 

						                    $region_pids = new Regionpids;
						                    foreach($pro_ids as $key => $values) {
						                        $property_ids[] = $values;

						                        // insert to table and cross check on properties table
						                         if(in_array($values,$array_pids)) {
						                         	// let's try eloquent model
							                        $region_pids->region_id = $region_id;
							                        $region_pids->property_ids = $values;
							                        $region_pids->region_parent = $id;
							                        $region_pids->save();
							                        $rows_updated++;
						                         }

						                    }
						                    
						           
						                   // $property_ids = serialize($property_ids);

						                } else {
						                    //$themes = "";
						                    $property_ids = "";
						                } 



						                //property expanded
						                if(!empty($newresult->property_ids_expanded)) {
						                    $pro_exp = $newresult->property_ids_expanded;
						                    // iterate thru theme array 
						                    $property_ids_expanded = array(); 
						                    foreach($pro_exp as $key => $evalues) {
						                        $property_ids_expanded[] = $evalues;

						                        // let's try eloquent model
						                        if(in_array($evalues,$array_pids)) {
							                        $region_pids = new Regionpids;
							                        $region_pids->region_id = $region_id;
							                        $region_pids->property_ids_exp = $evalues;
							                        $region_pids->region_parent = $id;
							                        $region_pids->save();
							                        $rows_updated++;
						                    	}
						                    }

						                   // $property_ids_expanded = serialize($property_ids_expanded);

						                } else {
						                    //$themes = "";
						                    $property_ids_expanded = "";
					                	}


					                	// INSERT TO TABLE
						            	$updated_date = date('Y-m-d H:i:s');

						                   /* $affected = Db::table('expedia_expediaimport_regions')->where('region_id', $region_id)->update([
						                    	'updated_at' => $updated_date,
						                        //'region_id' => $region_id, 
						                        'property_ids' => $property_ids,
						                        'property_ids_expanded' => $property_ids_expanded	                       
						                     ]);*/

						                    /*if($affected > 0) {

						                    	$rows_updated++;
						                    } */

						            } else {

						            	\Log::info('End of records.');

						            } // endif empty results


				                } // end FOR EACH 


				                //\Flash::success('Region found ok');
				                //\Log::info('Batch ' .$ctr. ' - property ids updated - '.$rows_updated);
				                $rows_updated = 0;
				                $ctr++;

				                // Lets put a delay
					             if(sleep(5)!=0)
								 {
								    //\Log::useFiles('storage/logs/update.log');
								    \Log::error("Delay Error");
								    break;
								 } else {
								 	//\Log::useFiles('storage/logs/update.log');
								 	//\Log::info("Waiting for 5 Seconds. Updating property ids.");
								 }
				   

				            } else {
				                        
				                \Flash::error('Region Not Found');
				                $withLink = 0;
				                break;

				            }



		    		} // end While loop

		    		// \Log::info('Done updating region property ids.');

				} // End If for checking empty ID	

		} // End for each Region ID  (main)

		 \Log::info('Done updating region property ids.');

	} // Public function 







} // End Class

 ?>