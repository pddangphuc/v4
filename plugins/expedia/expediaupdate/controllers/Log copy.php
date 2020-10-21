<?php namespace Expedia\ExpediaUpdate\Controllers;

use App;
use Lang;
use Flash;
use Db;
use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Storage;

class Log extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Expedia.ExpediaUpdate', 'main-menu-expedia-update');
    }

    public function index_onRefresh()
    {
        return $this->listRefresh();
    }


    public function onCheckUpdate() {
    	 // Get the properties saved on Database
        $properties = Db::select('select property_id, name, dates_updated from expedia_expediaimport_properties');  
        $prop_count = Db::table('expedia_expediaimport_properties')->count();


        if(!empty(Input::get('date_started')) && !empty(Input::get('date_end'))) {

    	// \Log::info("Date Start:" . $date_start. "/". "Date End:" . $date_end);
			$date_start = date('Y-m-d', strtotime(Input::get('date_started')));
    		$date_end = date('Y-m-d',strtotime(Input::get('date_end')));

    		$pre_qry = "https://test.ean.com/2.4/properties/content?language=en-US&date_updated_start=".$date_start."&date_updated_end=".$date_end;

    	} else {
    		$pre_qry = "https://test.ean.com/2.4/properties/content?language=en-US";
    		// \Log::error('No date Inputted');
    	}
       


        if(!empty($properties)) {

        	$qry_string = "";

        	// let's do it per batch

        	$batch_ctr = 0;

      
        	foreach($properties as $property) {

        		$property_id = $property->property_id;

        		$qry_string = $qry_string . "&property_id=". $property_id;

        		//adjust counters
        		$batch_ctr++;
        		$prop_count--;
 

        	

	        	//Call Api when batch counter satisfy

	        	if($batch_ctr == 30 && $prop_count >= 0 ) {	


		        	 // API Settings from backend
			        $apiKey = "1d99ilkinggvercocq9u21ki1p";
			        $secret = "bep3s64f1ou57";
			        $timestamp = time();
			        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();
			        		
		        	
			        // Initialize API connection
			        $curl = curl_init();


			        //$qry_string = "&property_id=560677";




			        // make the call 
			        curl_setopt_array($curl, array(
			          CURLOPT_URL => $pre_qry . $qry_string,
			         // CURLOPT_URL => "https://test.ean.com/2.4/properties/content?language=en-US&property_id=" . $property_id,
			          CURLOPT_RETURNTRANSFER => true,
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
			        $response = curl_exec($curl);
			        curl_close($curl);

			        // converts them to array
		        	$results = json_decode($response);


		        	// Check if results are empty
		        	if (!empty($results)) {
		            
		            	// Do the comparison Here 


		            	// put EPS results into the array
		            	foreach ($results as $key => $value) { 
		                    $newresult = $value; 

		                     if (isset($newresult->property_id)) {

			                	// put them to vars 
			                	$eps_property_id = $newresult->property_id;
			                    $eps_name = $newresult->name;
			                    $eps_date_updated = $newresult->dates->updated;
			                    $eps_images =  !empty($newresult->images) ? $newresult->images : "";



			                    // Check if there are updates on name, images and date updated
			                    $name_query = Db::table('expedia_expediaimport_properties')->select('name', 'dates_updated')->where('property_id', $eps_property_id)->first();
			                    //Db::table('users')->select('name', 'email as user_email')->get();

			                    if($name_query->dates_updated == $eps_date_updated) {
			                    	//\Log::useFiles('storage/logs/update.log');
			                    	//\Log::info($eps_property_id."-"." No updates");

			                    } else {

			                    	$msg = "";

			                    	// Check Name updates
			                    	if($name_query->name <> $eps_name) {
			                    		$change_type = "Name";
			                    		$msg = "Property name update";
			                    	} 

			                    	// Check for Images Updates 
			                    	$eps_img_count = count($eps_images);
			                    	$img_count = Db::table('expedia_expediaimport_images')->select('name', 'dates_updated')->where('property_id', $eps_property_id)->count();

			                    	if($eps_img_count != $img_count) {
			                    		$change_type = "Image";
			                    		if(!empty($msg)) {
			                    			$msg = $msg." and Images";
			                    		} else {
			                    			$msg = "images";
			                    		}

			                    		//Update Images Database

			                    		$deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $eps_property_id and poster IS NUll");
		                    			$deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $eps_property_id and poster <> 1");


		                    			foreach($eps_images as $ivalue) {


					                        $imglinks = !empty($ivalue->links) ? serialize($ivalue->links) : "";
					                        $links_thumb = !empty($ivalue->links->{'70px'}->href) ? $ivalue->links->{'70px'}->href : "";
					                        $links_small = !empty($ivalue->links->{'350px'}->href) ? $ivalue->links->{'350px'}->href : "";
					                        $links_large = !empty($ivalue->links->{'1000px'}->href) ? $ivalue->links->{'1000px'}->href : "";

					                        $caption = !empty($ivalue->caption) ? $ivalue->caption : "";
					                        $hero_image = !empty($ivalue->hero_image) ? $ivalue->hero_image : "0";
					                        $img_category = !empty($ivalue->category) ? $ivalue->category : "";

					                        Db::table('expedia_expediaimport_images')->updateOrInsert(
					                            ['property_id' => $eps_property_id, 'links_large' => $links_large],
					                            [
					                            'property_id' => $eps_property_id,
					                            'caption' => $caption,
					                            'hero_image' => $hero_image, 
					                            'category' => $img_category,
					                            'links' => $imglinks,
					                            'links_thumb' => $links_thumb,
					                            'links_small' => $links_small,
					                            'links_large' => $links_large
					                         ]);

					                    }



			                    	} else {
			                    		$change_type = "Other";
			                    		$msg = "N/A";
			                    	}


			                    	// Save Updates to our Database
			                    	//fetch them to variables

			                        //$property_id = $newresult->property_id;
			                        //$name = $newresult->name;
			                        $address_1 = !empty($newresult->address->line_1) ? $newresult->address->line_1 : "";
			                        $address_2 = !empty($newresult->address->line_2) ? $newresult->address->line_2 : "";
			                        $city = !empty($newresult->address->city) ? $newresult->address->city : "";
			                        $state = !empty($newresult->address->state_province_name) ? $newresult->address->state_province_name : "";
			                        $state_province_code = !empty($newresult->address->state_province_code) ? $newresult->address->state_province_code : "";
			                        $state_province_name = !empty($newresult->address->state_province_name) ? $newresult->address->state_province_name : "";
			                        $postal_code = !empty($newresult->address->postal_code) ? $newresult->address->postal_code : "";
			                        $country_code = !empty($newresult->address->country_code) ? $newresult->address->country_code : "";
			                        $obfuscation = !empty($newresult->address->obfuscation_required) ? $newresult->address->obfuscation_required : 0;


			                        if(!empty($newresult->localized->links)) {
			                            $localized_links  = $newresult->localized->links;
			                            // iterate thru attributes pets array 
			                            foreach($localized_links  as $pkey => $pvalues) {
			                                $newlocalized_links[] = $pvalues;
			                            }

			                            $newlocalized_links = serialize($newlocalized_links);

			                        } else {
			                            //$newattributes_pets = array("id"=>"0", "name" => "Nothing to display", "status" => 0);
			                            $newlocalized_links = "";
			                        }


			                        // Initialize vars for ratings
			                        $ratings = !empty($newresult->ratings->property->rating) ? $newresult->ratings->property->rating : "";
			                        $ratings_type = !empty($newresult->ratings->property->type) ? $newresult->ratings->property->type : "";
			                        $guest_count = !empty($newresult->ratings->guest->count) ? $newresult->ratings->guest->count: 0;
			                        $guest_overall = !empty($newresult->ratings->guest->overall) ? $newresult->ratings->guest->overall: "";
			                        $guest_cleanliness = !empty($newresult->ratings->guest->cleanliness) ? $newresult->ratings->guest->cleanliness : "";
			                        $guest_service = !empty($newresult->ratings->guest->service) ? $newresult->ratings->guest->service : "";
			                        $guest_comfort = !empty($newresult->ratings->guest->comfort) ? $newresult->ratings->guest->comfort : "";
			                        $guest_condition = !empty($newresult->ratings->guest->condition) ? $newresult->ratings->guest->condition : "";
			                        $guest_location = !empty($newresult->ratings->guest->location) ? $newresult->ratings->guest->location : "";
			                        $guest_neighborhood = !empty($newresult->ratings->guest->neighborhood) ? $newresult->ratings->guest->neighborhood : "";
			                        $guest_quality = !empty($newresult->ratings->guest->quality) ? $newresult->ratings->guest->quality : "";
			                        $guest_value = !empty($newresult->ratings->guest->value) ? $newresult->ratings->guest->value : "";
			                        $guest_amenities = !empty($newresult->ratings->guest->amenities) ? $newresult->ratings->guest->amenities : "";
			                        $guest_recommendation_percent = !empty($newresult->ratings->guest->guest_recommendation_percent) ? $newresult->ratings->guest->guest_recommendation_percent : "";


			                        $latitude = !empty($newresult->location->coordinates->latitude) ? $newresult->location->coordinates->latitude: "";
			                        $longitude = !empty($newresult->location->coordinates->longitude) ? $newresult->location->coordinates->longitude: "";
			                        $phone = !empty($newresult->phone) ? $newresult->phone : "";
			                        $fax  = !empty($newresult->fax) ? $newresult->fax : "";
			                        $category_id = $newresult->category->id;
			                        $category_name = $newresult->category->name;
			                        $rank = $newresult->rank;
			                        $expedia_collect = $newresult->business_model->expedia_collect;
			                        $property_collect = $newresult->business_model->property_collect;

			                        if(!empty($newresult->checkin->begin_time)) {
			                            $chkin_begin_time = $newresult->checkin->begin_time;
			                            
			                        } else {
			                            $chkin_begin_time = "";
			                            
			                        }


			                        if(!empty($newresult->checkin->end_time)) {
			                            $chkin_end_time = $newresult->checkin->end_time;
			                        } else {
			                            $chkin_end_time ="";
			                        }

			                        $chkin_instructions = !empty($newresult->checkin->instructions) ? $newresult->checkin->instructions : ""; 
			                        $chkin_special_instructions = !empty($newresult->checkin->special_instructions) ? $newresult->checkin->special_instructions : "";
			                        //$chkin_min_age = $newresult->checkin->min_age;
			                        
			                        if(!empty($newresult->checkin->min_age)) {
			                            $chkin_min_age = $newresult->checkin->min_age;
			                        } else {
			                            $chkin_min_age = 0;
			                        }

			                        $chkout_time = !empty($newresult->checkout->time) ? $newresult->checkout->time : "";

			                        $fees_mandatory = !empty($newresult->fees->mandatory) ? $newresult->fees->mandatory : "";
			                        $fees_optional = !empty($newresult->fees->optional) ? $newresult->fees->optional : "";
			                        //$policies_before_you_go = $newresult->policies->know_before_you_go;
			                        
			                        if(!empty($newresult->policies->know_before_you_go)) {
			                            $policies_before_you_go = $newresult->policies->know_before_you_go;
			                        } else {
			                            $policies_before_you_go = "";
			                        }


			                        $rooms =  !empty($newresult->rooms) ? $newresult->rooms : "";
		                        	$amenities =  !empty($newresult->amenities) ? $newresult->amenities : "";

		                        	$onsite_payments_currency =  !empty($newresult->onsite_payments->currency) ? $newresult->onsite_payments->currency : "";
			                        //$onsite_payments_types =  !empty($newresult->onsite_payments->types) ? $newresult->onsite_payments->types : "";
			                        if(!empty($newresult->onsite_payments->types)) {
			                            $onsite_payments_types = $newresult->onsite_payments->types;

			                            // iterate thru attributes general array 
			                            $newonsite_payments_types =[];
			                            foreach($onsite_payments_types as $gkey => $gvalues) {
			                                $newonsite_payments_types[] = $gvalues;
			                            }
			                            $newonsite_payments_types = serialize($newonsite_payments_types);


			                        } else {
			                            //$newattributes_general = array("id"=>"0", "name" => "Nothing to display", "status" => 0);
			                            $newonsite_payments_types = "";
			                        }


			                        $dates_added = $newresult->dates->added;
			                        $dates_updated = $newresult->dates->updated;
			                        $desc_amenities = !empty($newresult->descriptions->amenities) ? $newresult->descriptions->amenities : "";
			                        //$desc_dining = $newresult->descriptions->dining;
			                        $desc_dining  = !empty($newresult->descriptions->dining) ? $newresult->descriptions->dining : "";
			                        $desc_renovations = !empty($newresult->descriptions->renovations) ? $newresult->descriptions->renovations : "";
			                        $desc_business_amenities = !empty($newresult->descriptions->business_amenities) ? $newresult->descriptions->business_amenities : "";
			                        $desc_rooms = !empty($newresult->descriptions->rooms) ? $newresult->descriptions->rooms : "";
			                        $desc_attractions = !empty($newresult->descriptions->attractions) ? $newresult->descriptions->attractions : "";
			                        $desc_location = !empty($newresult->descriptions->location) ? $newresult->descriptions->location : "";
			                        $desc_headline = !empty($newresult->descriptions->headline) ? $newresult->descriptions->headline : "";


			                        if(!empty($newresult->all_inclusive)) {
			                            $inc_all_rate_plans = $newresult->all_inclusive->all_rate_plans;
			                            $inc_some_rate_plans = $newresult->all_inclusive->some_rate_plans;
			                            $inc_details = $newresult->all_inclusive->details;
			                        } else {
			                            $inc_all_rate_plans = "0";
			                            $inc_some_rate_plans = "0";
			                            $inc_details = "";
			                        }

			                        //$themes = $newresult->themes;
			                        if(!empty($newresult->themes)) {
			                            $themes = $newresult->themes;
			                            // iterate thru theme array 
			                            $newtheme = [];
			                            foreach($themes as $key => $values) {
			                                $newtheme[] = $values;
			                            }

			                            $newtheme = serialize($newtheme);

			                        } else {
			                            //$themes = "";
			                            $newtheme = "";
			                        }


			                        //$statistics = $newresult->statistics;
			                        if(!empty($newresult->statistics)) {
			                            $statistics = $newresult->statistics;
			                            // iterate thru theme array 
			                            $newstatistics = [];
			                            foreach($statistics as $skey => $svalues) {
			                                $newstatistics[] = $svalues;
			                            }

			                            $newstatistics = serialize($newstatistics);

			                        } else {
			                            $statistics = "";
			                            $newstatistics ="";
			                        }


			                        if(!empty($newresult->attributes->pets)) {
			                            $attributes_pets = $newresult->attributes->pets;
			                            // iterate thru attributes pets array 
			                            $newattributes_pets = [];
			                            foreach($attributes_pets as $pkey => $pvalues) {
			                                $newattributes_pets[] = $pvalues;
			                            }

			                            $newattributes_pets = serialize($newattributes_pets);

			                        } else {
			                            //$newattributes_pets = array("id"=>"0", "name" => "Nothing to display", "status" => 0);
			                            $newattributes_pets = "";
			                        }
			                        

			                        if(!empty($newresult->attributes->general)) {
			                            $attributes_general = $newresult->attributes->general;

			                            // iterate thru attributes general array 
			                            $newattributes_general = [];
			                            foreach($attributes_general as $gkey => $gvalues) {
			                                $newattributes_general[] = $gvalues;
			                            }
			                            $newattributes_general = serialize($newattributes_general);


			                        } else {
			                            //$newattributes_general = array("id"=>"0", "name" => "Nothing to display", "status" => 0);
			                            $newattributes_general = "";
			                        }



			                        $airport_code = !empty($newresult->airports->preferred->iata_airport_code) ? $newresult->airports->preferred->iata_airport_code : "";
			                        $chain_id = $newresult->chain->id;
			                        $chain_name = $newresult->chain->name;
			                        $brand_id = $newresult->brand->id;
			                        $brand_name = $newresult->brand->name;
			                        $multi_unit = $newresult->multi_unit;
			                        $pay_reg_recommended = $newresult->payment_registration_recommended;
			                        $spoken_languages =  !empty($newresult->spoken_languages) ? serialize($newresult->spoken_languages) : "";

			                        $updated_date = date('Y-m-d H:i:s');

			                        // Update record on Database 
		                        
			                        Db::table('expedia_expediaimport_properties')->where('property_id',$eps_property_id)->update([
			                            'name' => $eps_name,
			                            'updated_at' => $updated_date,
			                            'address_1' => $address_1,
			                            'address_2' => $address_2,
			                            'city' => $city,
			                            'state' => $state,
			                            'state_province_code' => $state_province_code, 
			                            'state_province_name' => $state_province_name,
			                            'postal_code' => $postal_code,
			                            'country_code' => $country_code,
			                            'obfuscation' => $obfuscation,
			                            'localized_links' => $newlocalized_links,
			                            'latitude' => $latitude,
			                            'longitude' => $longitude,
			                            'phone' => $phone,
			                            'fax' => $fax,
			                            'category_id' => $category_id,
			                            'category_name' => $category_name,
			                            'rank' => $rank,
			                            'expedia_collect' => $expedia_collect,
			                            'property_collect' => $property_collect,
			                            'chkin_begin_time' => $chkin_begin_time,
			                            'chkin_end_time' => $chkin_end_time,
			                            'chkin_instructions' => $chkin_instructions,
			                            'chkin_special_instructions' => $chkin_special_instructions,
			                            'chkin_min_age' => $chkin_min_age,
			                            'chkout_time' => $chkout_time,
			                            'fees_optional' => $fees_optional,
			                            'fees_mandatory' => $fees_mandatory,
			                            'policies_before_you_go' => $policies_before_you_go,
			                            'onsite_payments_currency' => $onsite_payments_currency,
			                            'onsite_payments_types' => $newonsite_payments_types,
			                            'dates_added' => $dates_added,
			                            'dates_updated' => $dates_updated,
			                            'desc_amenities' => $desc_amenities,
			                            'desc_dining' => $desc_dining,
			                            'desc_renovations' => $desc_renovations,
			                            'desc_buss_amenities' => $desc_business_amenities,
			                            'desc_rooms' => $desc_rooms,
			                            'desc_attractions' => $desc_attractions,
			                            'desc_location' => $desc_location,
			                            'desc_headline'=> $desc_headline,
			                            'themes' => $newtheme,
			                            'inc_all_rate_plans' => $inc_all_rate_plans,
			                            'inc_some_rate_plans' => $inc_some_rate_plans,
			                            'inc_details' => $inc_details,
			                            'statistics' => $newstatistics,
			                            'attributes_pets' => $newattributes_pets,
			                            'attributes_general' => $newattributes_general,
			                            'airport_code' => $airport_code,
			                            'chain_id' => $chain_id,
			                            'chain_name' => $chain_name,
			                            'brand_id' => $brand_id,
			                            'brand_name' => $brand_name,
			                            'spoken_languages' => $spoken_languages,
			                            'multi_unit' => $multi_unit,
			                            'pay_reg_recommended' => $pay_reg_recommended

			                         ]);

			                        // Insert to ratings table 
			                         Db::table('expedia_expediaimport_ratings')->where('property_id',$eps_property_id)->update([
			                            //'property_id' => $property_id, 
			                            // Initialize vars for ratings
			                            'property_rating' => $ratings,
			                            'property_rating_type' => $ratings_type,
			                            'guest_count' => $guest_count,
			                            'guest_overall' => $guest_overall,
			                            'guest_cleanliness' => $guest_cleanliness,
			                            'guest_service' => $guest_service,
			                            'guest_comfort' => $guest_comfort,
			                            'guest_condition' => $guest_condition,
			                            'guest_location' => $guest_location,
			                            'guest_neighborhood' => $guest_neighborhood,
			                            'guest_quality' => $guest_quality,
			                            'guest_value' => $guest_value,
			                            'guest_amenities' => $guest_amenities,
			                            'guest_recommendation_percent' => $guest_recommendation_percent
			                            
			                         ]);



			                         // Save Rooms 

		                            if(!empty($rooms)) {

		                            $deleted_rooms = Db::delete("delete from expedia_expediaimport_rooms where property_id = $eps_property_id");
		                            $deleted_amenities = Db::delete("delete from expedia_expediaimport_amenities where property_id = $eps_property_id");

		                                foreach($rooms as $rkey => $rvalue) {
		                                     //$rooms_array[] = $rvalues;
		                                     //$roomkey[] = $rvalue->id;
		                                     //$roomvalue[] = $rvalue->name;
		                                    $room_id = !empty($rvalue->id) ? $rvalue->id : ""; 
		                                    $room_name = !empty($rvalue->name) ? $rvalue->name : ""; 
		                                    $room_desc = !empty($rvalue->description->overview) ? $rvalue->description->overview : "";
		                                    $room_area = !empty($rvalue->area) ? $rvalue->area : "";
		                                    $room_views = !empty($rvalue->views) ? $rvalue->views : "";
		                                    $room_occupancy_max_allowed = !empty($rvalue->occupancy->max_allowed) ? $rvalue->occupancy->max_allowed : "";
		                                    $room_occupancy_age_categories= !empty($rvalue->occupancy->age_categories) ? $rvalue->occupancy->age_categories : "";



		                                     Db::table('expedia_expediaimport_rooms')->insert([
		                                        'property_id' => $eps_property_id,
		                                        'room_id' => $room_id ,
		                                        'room_name' => $room_name,
		                                        'room_description' => $room_desc,
		                                        'room_area' =>  serialize($room_area),
		                                        'room_views' => serialize($room_views),
		                                        'room_occupancy_max_allowed' =>serialize($room_occupancy_max_allowed),
		                                        'room_occupancy_age_categories' =>serialize($room_occupancy_age_categories)
		                                     ]);

		                                     

		                                     // Save room amenities

		                                     //$room_amenities = !empty($rvalue->amenities) ? $rvalue->amenities : "";
		                                     $room_amenities = $rvalue->amenities;

		                                     if(!empty($room_amenities)) {

		                                     	$deleted_room_amenities = Db::delete("delete from expedia_expediaimport_room_amenities where property_id = $eps_property_id");
		                                         foreach($room_amenities as $rakey => $ravalue) {

		                                            $has_value  = !empty($ravalue->value) ? $ravalue->value : "";

		                                            Db::table('expedia_expediaimport_room_amenities')->insert([
		                                                'property_id' => $eps_property_id,
		                                                'room_id' => $rvalue->id,
		                                                'amenities_id' => $ravalue->id,
		                                                'amenities_name' => $ravalue->name,
		                                                'amenities_value' => $has_value
		                                            ]);


		                                         }
		                                    }

		                                     //save bed groups is exist
		                                     $bed_groups =  !empty($rvalue->bed_groups) ? $rvalue->bed_groups : "";

		                                     if(!empty($bed_groups)) {

		                                     	$deleted_room_bed_groups = Db::delete("delete from expedia_expediaimport_room_bed_groups where property_id = $eps_property_id");
		                                         foreach($bed_groups as $bgkey => $bgvalue) {

		                                        
		                                            Db::table('expedia_expediaimport_room_bed_groups')->insert([
		                                                'property_id' => $eps_property_id,
		                                                'room_id' => $rvalue->id,
		                                                'bed_groups_id' => $bgvalue->id,
		                                                'description' => $bgvalue->description,
		                                                'configuration' => serialize($bgvalue->configuration)
		                                            ]);


		                                         }
		                                    }

		                                
		                                } //end save rooms 




										// Save Property Amenities

			                            foreach($amenities as $akey => $avalue) {

			                                $has_value  = !empty($avalue->value) ? $avalue->value : "";

			                                 Db::table('expedia_expediaimport_amenities')->insert([
			                                    'property_id' => $eps_property_id,
			                                    'amenities_id' => $avalue->id,
			                                    'amenities_name' => $avalue->name,
			                                    'amenities_value' => $has_value
			                                 ]);
			                            }

		                            } //endif  !empty rooms


		                            if(strtolower($change_type) == "image") {
		                            	$msg = "EPS Images count:".$eps_img_count."/". "DB Images Count:". $img_count;
		                            }

		                            //Lastly Insert them to log DB
		                             $created_date = date('Y-m-d H:i:s');
		                             Db::table('expedia_expediaupdate_log')->insert([
		                                        'property_id' => $eps_property_id,
		                                        'level' => 'Info', 
		                                        'message' => $msg,
		                                        'property_name' => $eps_name,
		                                        'change_type' => $change_type, 
		                                        'created_at'=> $created_date
		                                     ]);


		                           // \Log::useFiles('storage/logs/update.log');
			                    //	\Log::info($eps_property_id."-"." with updates on ". $msg);

			                    	//\Log::info($eps_property_id."-"." with updates on ". $msg);

			                    } // end checking dates_updated


			                  // \Log::info("$eps_property_id"."-".$eps_name);
		                     	// \Log::useFiles('storage/logs/mycustom.log');
		                     	//\trace_log($eps_property_id);

		                	}

		                 } 

		                 // \Flash::success("added notification.");
		                 // \trace_log($newresult);

		                 //print_r($results);

		                    // \Log::useFiles('storage/logs/mycustom.log');
		            		// \Log::debug("scheduled custom log!");
		            		//\trace_log($newresult->property_id);

			        } else {
			          //  \Log::error("No properties found in the Database.");
			          \Flash::error("Can't connect to EPS");

			        }  // end EPS connection and results checking


		        	// reset batch counter
		        	$batch_ctr = 0;

		        	// reset querty after updated batch
		        	$qry_string = "";

		        // Lets put a delay
	             if(sleep(10)!=0)
				 {
				    //\Log::useFiles('storage/logs/update.log');
				    \Log::error("Delay Error");
				    break;
				 } else {
				 	//\Log::useFiles('storage/logs/update.log');
				 	\Log::info("Waiting for 10 Seconds. Updating properties");
				 }

		    	} elseif($prop_count == 1) {

		    		$batch_ctr = 29;

		    	} // END IF Batch checker 
        	
        	} // end foreach Parent


        	\Flash::info("Properties updated.");
        	\Log::info("Properties updated.");


        } else {
        	 \Flash::error("No properties found in the Database.");

        } // End DB connection

       
    } // onCheckUpdate()



  


    public function onActioned() {

    	 if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $recordId) {
            	$toSearch = Db::table('expedia_expediaupdate_log')->where('id', $recordId)->first();
                if (!$record = $toSearch) {
                    continue;
                }
                //$record->delete();

                Db::table('expedia_expediaupdate_log')->where('id', $recordId)->update(['actioned' => 1]);
                //\Log::debug("Actioned - ". $recordId);


            }

            Flash::success("Actioned selected records");
        }
        else {
            Flash::error("There are no selected records to update");
        }

        return $this->listRefresh();

    }


    public function onFilterDate() {
//date('d-m-Y', strtotime($user->from_date));

    	$prop_count = Db::table('expedia_expediaimport_properties')->count();
    	$date_start = date('Y-m-d', strtotime(Input::get('date_started')));
    	$date_end = date('Y-m-d',strtotime(Input::get('date_end')));

    	if(!empty(Input::get('date_started')) && !empty(Input::get('date_end'))) {

    	\Log::info("Date Start:" . $date_start. "/". "Date End:" . $date_end . "/Count:".$prop_count);
    	} else {
    		\Log::error('No date Inputted');
    	}

    }

    public function index_onEmptyLog()
    {
        //Log::truncate();
        Db::table('expedia_expediaupdate_log')->truncate();
        Flash::success(Lang::get('system::lang.event_log.empty_success'));
        return $this->listRefresh();
    }

}
