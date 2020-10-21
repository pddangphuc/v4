<?php namespace Expedia\ExpediaImport\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Log;
use Db;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Storage;


class Property extends Controller
{

    public $implement = [             
    	
        'Backend\Behaviors\ListController'
    ];
    

   // public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    //public $relationConfig = 'config_relation.yaml';


    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Expedia.ExpediaImport', 'main-menu-expedia-import');
    }



    /*public function index() {
    	$config = $this->makeConfig('$/expedia/expediaimport/models/property/columns.yaml');
        //$config->model = new \Expedia\ExpediaImport\Models\Images;

        // to edit with value in the fields
        $config->model = new \Expedia\ExpediaImport\Models\Property;

        $config->recordUrl = 'expedia/expediaimport/property/update/:id';

        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        $widget->bindToController();

        $this->vars['widget'] = $widget;

    }*/


     // Impport Data ffrom Expedia
    public function create_onImport() {

        $id = Input::get('txtpropertyid');
        //Log::info('Parameter:'. $id);

    

        if(!empty($id)) {

        //check if duplicate 
            $duplicate = Db::table('expedia_expediaimport_properties')->where('property_id', $id)->first();

            if(!empty($duplicate)) {

                if ($duplicate->property_id == $id) {
                    
                    //Log::info('Sorry! Something is wrong with this account!:'. $id);
                    //\Flash::success('Property already exist. Property updated');

                    $myDuplicate = 1;

                   // return;
                } 

            }


        
        // API Settings from backend
        $apiKey = "1d99ilkinggvercocq9u21ki1p";
        $secret = "bep3s64f1ou57";
        $timestamp = time();
        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();

        // Initialize API connection
        $curl = curl_init();

        // make the call
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://test.ean.com/2.4/properties/content?property_id=". $id ."&language=en-US",
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




        // Check and Add to database
        // Log call and check if there's an error to response
            if (array_key_exists('type', $results)) {
                //echo "Error:". current($results). "<br />" ;
                //echo "Error: $results->type Message: $results->message";
                //echo current($results);


                // add error code 
                switch ($results->type) {
                    case "invalid_input":
                        $errcode = "400";
                        break;
                    case "version.required":
                        $errcode = "400";
                        break;
                    case "version.unsupported":
                        $errcode = "400";
                        break;
                    case "request_unauthenticated":
                        $errcode = "401/403";
                        break;
                    case "resource.not_found":
                        $errcode = "404";
                        break;
                    case "link.expired":
                        $errcode = "410";
                        break;
                    case "upgrade_required":
                        $errcode = "426";
                        break;
                    case "unknown_internal_error":
                        $errcode = "500";
                        break; 
                    case "internal_error":
                        $errcode = "500";
                        break;
                    case "service_unavailable":
                        $errcode = "503";
                        break;           
                    default:
                        $errcode = "Unknown";
                }



                // call
                //Log::info('An API call was made');
                // response
                Log::error('EPS API call but with error:'.$errcode.'-'.$results->type.'-'. $results->message);


            } else {

                // check array if not empty and get array values
                if (!empty($results)) {

                    foreach ($results as $key => $value) { 
                        $newresult = $value; 
                    } 

                    
                    if (isset($newresult)) {
                        //$pname = $newresult->name;
                        //echo '<p data-control="flash-message" data-interval="5" class="success">ID:'.$idnum.' Name:'.$pname.'</p>';

                        //fetch them to variables

                        $property_id = $newresult->property_id;
                        $name = $newresult->name;
                        $address_1 = !empty($newresult->address->line_1) ? $newresult->address->line_1 : "";
                        $address_2 = !empty($newresult->address->line_2) ? $newresult->address->line_2 : "";
                        $city = !empty($newresult->address->city) ? $newresult->address->city : "";
                        $state = !empty($newresult->address->state_province_name) ? $newresult->address->state_province_name : "";
                        $state_province_code = !empty($newresult->address->state_province_code) ? $newresult->address->state_province_code : "";
                        $state_province_name = !empty($newresult->address->state_province_name) ? $newresult->address->state_province_name : "";
                        $postal_code = !empty($newresult->address->postal_code) ? $newresult->address->postal_code : "";
                        $country_code = !empty($newresult->address->country_code) ? $newresult->address->country_code : "";
                        $obfuscation = !empty($newresult->address->obfuscation_required) ? $newresult->address->obfuscation_required : 0;
                        //$localized_links = !empty($newresult->localized->links) ? $newresult->localized->links : "";

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


                        $latitude = $newresult->location->coordinates->latitude;
                        $longitude = $newresult->location->coordinates->longitude;
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
                        $images =  !empty($newresult->images) ? $newresult->images : "";




                        $onsite_payments_currency =  !empty($newresult->onsite_payments->currency) ? $newresult->onsite_payments->currency : "";
                        //$onsite_payments_types =  !empty($newresult->onsite_payments->types) ? $newresult->onsite_payments->types : "";
                        if(!empty($newresult->onsite_payments->types)) {
                            $onsite_payments_types = $newresult->onsite_payments->types;

                            // iterate thru attributes general array 
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

                        //create date imported
                        $created_date = date('Y-m-d H:i:s');


                        


                        if(empty($myDuplicate)) {
                        // Insert to DB table 
                        
                         Db::table('expedia_expediaimport_properties')->insert([
                            'property_id' => $property_id, 
                            'name' => $name,
                            'created_at' => $created_date,
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
                         Db::table('expedia_expediaimport_ratings')->insert([
                            'property_id' => $property_id, 
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
                                        'property_id' => $property_id,
                                        'room_id' => $room_id,
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
                                     foreach($room_amenities as $rakey => $ravalue) {

                                        $has_value  = !empty($ravalue->value) ? $ravalue->value : "";

                                        Db::table('expedia_expediaimport_room_amenities')->insert([
                                            'property_id' => $property_id,
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
                                         foreach($bed_groups as $bgkey => $bgvalue) {

                                        
                                            Db::table('expedia_expediaimport_room_bed_groups')->insert([
                                                'property_id' => $property_id,
                                                'room_id' => $rvalue->id,
                                                'bed_groups_id' => $bgvalue->id,
                                                'description' => $bgvalue->description,
                                                'configuration' => serialize($bgvalue->configuration)
                                            ]);


                                         }
                                    }

                                
                                } //end save rooms 
                            }

                            // Save Property Amenities
                            if(!empty($amenities)) {
                                foreach($amenities as $akey => $avalue) {

                                    $has_value  = !empty($avalue->value) ? $avalue->value : "";

                                     Db::table('expedia_expediaimport_amenities')->insert([
                                        'property_id' => $property_id,
                                        'amenities_id' => $avalue->id,
                                        'amenities_name' => $avalue->name,
                                        'amenities_value' => $has_value
                                     ]);
                                }
                            }


                            // Save Images links on images table
                            if(!empty($images)) {
                                foreach($images as $ivalue) {


                                    $imglinks = !empty($ivalue->links) ? serialize($ivalue->links) : "";
                                    $links_thumb = !empty($ivalue->links->{'70px'}->href) ? $ivalue->links->{'70px'}->href : "";
                                    $links_small = !empty($ivalue->links->{'350px'}->href) ? $ivalue->links->{'350px'}->href : "";
                                    $links_large = !empty($ivalue->links->{'1000px'}->href) ? $ivalue->links->{'1000px'}->href : "";

                                    $caption = !empty($ivalue->caption) ? $ivalue->caption : "";
                                    $hero_image = !empty($ivalue->hero_image) ? $ivalue->hero_image : "0";
                                    $img_category = !empty($ivalue->category) ? $ivalue->category : "";

                                    Db::table('expedia_expediaimport_images')->insert([
                                        'property_id' => $property_id,
                                        'caption' => $caption,
                                        'hero_image' => $hero_image, 
                                        'category' => $img_category,
                                        'links' => $imglinks,
                                        'links_thumb' => $links_thumb,
                                        'links_small' => $links_small,
                                        'links_large' => $links_large
                                     ]);

                                }
                            }


                         \Flash::success('EPS Property has been imported');
                         } else {

                            // Duplicate found so just update it


                            // update table ratings 
                            // Insert to ratings table 
                             Db::table('expedia_expediaimport_ratings')->updateOrInsert([
                                'property_id' => $property_id], [ 
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

                              \Flash::success('Property already exist, updating.');



                        } // end Updating for Duplicate 

                    } else {
                        
                        \Flash::error('Property Not Found');
                    }

                } else {
                    //echo '<p data-control="flash-message" data-interval="3" class="error">Property not found or incorrect input.</p>';
                }
            } // If array exist 


        } //endif empty $id

    } // end onImport


    public function update($id=null) {

        
        $this->vars['myId'] = $id;
        //$this->vars['propertyId'] = $property_id;  
        

        //$property_id  = $data['property_id'];
        //$property_id  = Input::get('Property.property_id');
        
        

        $config = $this->makeConfig('$/expedia/expediaimport/models/property/fields.yaml');
        //$config->model = new \Expedia\ExpediaImport\Models\Images;

        $config->alias = 'propertyForm';

        $config->arrayname = 'Property';

        // to edit with value in the fields
        $config->model = \Expedia\ExpediaImport\Models\Property::find($id);

        $this->vars['propertyId']  = $config->model->property_id;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);
        $this->vars['widget'] = $widget;

        $this->pageTitle = "Update";


    } // update


    public function create() {
        $this->pageTitle = "Import";
        //return "hello";
        /*$config = $this->makeConfig('$/expedia/expediaimport/models/property/fields.yaml');

        $config->model = \Expedia\ExpediaImport\Models\Property::find($id);

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);
        $this->vars['widget'] = $widget;*/
    } // create


    public function onUpdate($id = null)
    {
        $data = post();

        // Check storage/logs/system.log
        //trace_log($data);


        $active = $data['active'];
        $slug = $data['slug'];
        $zoho = $data['zoho_id'];
        $meta_title = $data['meta_title'];
        $meta_desc = $data['meta_desc'];
        $robot_index = $data['robot_index'];
        $accommodation_type = $data['accommodation_type'];
        $collections = json_encode($data['collections']);
        $updated_date = date('Y-m-d H:i:s');


        Db::table('expedia_expediaimport_properties')->where('id', $id)->update([
            'active' => $active,
            'slug' => $slug,
            'zoho_id' => $zoho,
            'meta_title' => $meta_title,
            'meta_desc' => $meta_desc,
            'robot_index' => $robot_index,
            'accommodation_type' => $accommodation_type,
            'collections' => $collections,
            'updated_at' => $updated_date
        ]);

        \Flash::success('Property Saved');

        // Return a redirect
        // return \Backend::redirect('expedia/expediaimport/property');
        //return \Redirect::refresh();        

    } // onUpdate


    public function onUpdateClose($id = null)
    {
        $data = post();

        // Check storage/logs/system.log
        //trace_log($data);


        $active = $data['active'];
        $slug = $data['slug'];
        $zoho = $data['zoho_id'];
        $meta_title = $data['meta_title'];
        $meta_desc = $data['meta_desc'];
        $robot_index = $data['robot_index'];
        $accommodation_type = $data['accommodation_type'];
        $collections = json_encode($data['collections']);
        $updated_date = date('Y-m-d H:i:s');


        Db::table('expedia_expediaimport_properties')->where('id', $id)->update([
            'active' => $active,
            'slug' => $slug,
            'zoho_id' => $zoho,
            'meta_title' => $meta_title,
            'meta_desc' => $meta_desc,
            'robot_index' => $robot_index,
            'accommodation_type' => $accommodation_type,
            'collections' => $collections,
            'updated_at' => $updated_date
        ]);

        \Flash::success('Property Saved');

        // Return a redirect
         return \Backend::redirect('expedia/expediaimport/property');
        //return \Redirect::refresh();        

    } // onUpdate





    public function onUpdateImages () 
    {
        
        $property_id  = Input::get('property_id');
        //$property_id  = Input::get('Property.property_id');

        // API Settings from backend
        $apiKey = "1d99ilkinggvercocq9u21ki1p";
        $secret = "bep3s64f1ou57";
        $timestamp = time();
        $authHeader = 'Authorization: EAN APIKey=' . $apiKey . ',Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ',timestamp=' . time();

        // Initialize API connection
        $curl = curl_init();

        // make the call
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://test.ean.com/2.4/properties/content?property_id=". $property_id ."&language=en-US",
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



        if (!empty($results)) {

            foreach ($results as $key => $value) { 
                $newresult = $value; 
            } 


            if (isset($newresult)) {

                $images =  !empty($newresult->images) ? $newresult->images : "";


                // Save Images links on images table

                if(!empty($images)) {

                    //$deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $property_id and poster <> 1");
                    $deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $property_id and poster IS NUll");
                    $deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $property_id and poster <> 1");

                    foreach($images as $ivalue) {


                        $imglinks = !empty($ivalue->links) ? serialize($ivalue->links) : "";
                        $links_thumb = !empty($ivalue->links->{'70px'}->href) ? $ivalue->links->{'70px'}->href : "";
                        $links_small = !empty($ivalue->links->{'350px'}->href) ? $ivalue->links->{'350px'}->href : "";
                        $links_large = !empty($ivalue->links->{'1000px'}->href) ? $ivalue->links->{'1000px'}->href : "";

                        $caption = !empty($ivalue->caption) ? $ivalue->caption : "";
                        $hero_image = !empty($ivalue->hero_image) ? $ivalue->hero_image : "0";
                        $img_category = !empty($ivalue->category) ? $ivalue->category : "";

                        /*Db::table('expedia_expediaimport_images')->insert([
                            'property_id' => $property_id,
                            'caption' => $caption,
                            'hero_image' => $hero_image, 
                            'category' => $img_category,
                            'links' => $imglinks,
                            'links_thumb' => $links_thumb,
                            'links_small' => $links_small,
                            'links_large' => $links_large
                         ]);*/

                        Db::table('expedia_expediaimport_images')->updateOrInsert(
                            ['property_id' => $property_id, 'links_large' => $links_large, 'links_small' => $links_small, 'links_thumb' => $links_thumb],
                            [
                            'property_id' => $property_id,
                            'caption' => $caption,
                            'hero_image' => $hero_image, 
                            'category' => $img_category,
                            'links' => $imglinks,
                            'links_thumb' => $links_thumb,
                            'links_small' => $links_small,
                            'links_large' => $links_large
                         ]);
                        

                    }

                \Flash::success('Images updated for property  ' . $property_id);

                } else {

                \Flash::error('No images found on property ' . $property_id);
                return;
                //return print_r($images);

                }




            }

        }



    } // onUpdateImages



    public function onImportImages($id=null)  {

        //$recID = $this->id;

        // use this for behaviors enable
        //$property_id  = Input::get('Property.property_id');
       // $property_name  = Input::get('Property.name');

        // use this for normal form 
         $property_id  = Input::get('property_id');
         $property_name  = Input::get('name');
         $property_slug  = Input::get('slug');

        //$property_name ="What the heck";
        //\Flash::info('Loading Images' . $recID);


        // Pass this variable to partial via popup
        $this->vars['propertyId'] = $property_id; //post('property_id');

        return $this->makePartial('image_browser',['property_name' => $property_name, 'property_id' => $property_id, 'property_slug' => $property_slug ]);
            //$this->makePartial('image_browser');
        /*$url = 'https://pay.google.com/about/static/images/social/og_image.jpg';
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $info['basename']);*/

        /*$url = 'https://pay.google.com/about/static/images/social/og_image.jpg';
        //$url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put('media/'.$name, $contents);
        */
        //$imageData = DB::

    } // end onSaveImages()



    public function onCreateItem() {

        $property_id  = post('property_id');
        $property_name = post('property_name');
        $property_slug = post('property_slug');


        $data = post('selected_images');


        if(!empty($data)) {

            //$selected_images = Db::delete("delete from expedia_expediaimport_images where property_id = $property_id");
            $reset_images = Db::update("update expedia_expediaimport_images set poster = 0, links_large_sort_id = 0 where property_id = $property_id");

            $update_property = Db::update("update expedia_expediaimport_properties set media = 1 where property_id = $property_id");
            // Delete Images to clean directory for local disk remove " disk('s3')-> "


            // another solution 
            //$file = new Filesystem;
            //$file->cleanDirectory('storage/app/backgrounds');


            // Get all files in a directory
            $files =  Storage::disk('s3')->allFiles('media/properties/'.$property_id.'/');

            // Delete Files
            Storage::disk('s3')->delete($files);


            // create a directory for property based on Property Id
            //$directory = $property_id;
            //Storage::makeDirectory('media/properties/'. $directory);

            $ctr = 1;
            foreach($data as $value) {
                $imgID = $value;
                

                // create those files and save them to disk 

                $imgFiles = Db::table('expedia_expediaimport_images')->where('id', $imgID)->first();

                $url = $imgFiles->links_large;
                $contents = file_get_contents($url);
                $name = $property_slug."_".substr($url, strrpos($url, '/') + 1);
                //Storage::put('media/properties/'.$property_id.'/'.$name, $contents); //Local
                Storage::disk('s3')->put('media/properties/'.$property_id.'/'.$name, $contents);
              


                //update the selected image 
                $selected_images = Db::update("update expedia_expediaimport_images set poster = 1, newname = '$name' ,links_large_sort_id = '$ctr' where id = $imgID and property_id = $property_id");
                $ctr++;

            }

            \Flash::success('Images selected for property ');

            return \Redirect::refresh();

            // create those files and save them to disk



        } else {
            return;
        }


        // Check storage/logs/system.log
        //trace_log($data);

    //  return \Backend::redirect('expedia/expediaimport/property/create');
    }



    // Update Image Order 
    public function onUpdateOrder(){ 


        // Get images id and generate ids array 
        //$idArray = explode(",", post('ids')); 
        //$property_id  = Input::get('property_id');
        
        $data = post('ids');
        $property_id = post('pid');
        $count = 1;
        $ctr = 0 ; 

        if(!empty($data)) {
            // reset order
            $resetorder = Db::update("update expedia_expediaimport_images set links_large_sort_id = 0 where property_id = $property_id");

            foreach ($data as $img_id){ 
                //$update = $this->db->query("UPDATE ".$this->imgTbl." SET img_order = $count, modified = NOW() WHERE id = $id"); 
               $update = Db::update("update expedia_expediaimport_images set links_large_sort_id = $count, modified = NOW() where id = $img_id");
            //$str[] = "update expedia_expediaimport_images set links_large_sort_id = ". $count." where id = ". $img_id[$ctr];
               $count++;  
               $ctr++;   
            }
            //return TRUE; 

            //trace_log($data);
        

        } else {

            \Flash::error('No Images Selected');
            return;
        }

    } 



    public function onRefreshTime(){
        $property_id  = Input::get('property_id');
        $this->vars['propertyId'] = $property_id; 

    }

    public function onDelete($id=null) {

       $property_id  = Input::get('property_id');
        $this->vars['propertyId'] = $property_id; 
        $recId = $this->vars['redID'] = $id;

        // delete images 
        $deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = $property_id ");
        $deleted_amenities = Db::delete("delete from expedia_expediaimport_amenities where property_id = $property_id ");
        $deleted_rooms = Db::delete("delete from expedia_expediaimport_rooms where property_id = $property_id ");
        $deleted_ratings = Db::delete("delete from expedia_expediaimport_ratings where property_id = $property_id ");
        $deleted_bg = Db::delete("delete from expedia_expediaimport_room_bed_groups where property_id = $property_id ");
        $deleted_amenitites = Db::delete("delete from expedia_expediaimport_room_amenities where property_id = $property_id ");
        

        Db::table('expedia_expediaimport_properties')->where('id', '=', $recId)->delete();

        \Flash::success($property_id.' deleted');

        return \Backend::redirect('expedia/expediaimport/property');

    }



} // end class


?>