<?php namespace Expedia\ExpediaImport\Models;

use Model;
use Log;
use Db;
use Illuminate\Support\Facades\Input;
use October\Rain\Support\Facades\Flash;
use Redirect;
//use Exception;
//use Illuminate\Support\Facades\Redirect;
use October\Rain\Exception\ValidationException;

/**
 * Model
 */
class Property extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    //use \October\Rain\Database\Traits\SoftDelete;

    //protected $dates = ['deleted_at'];




    /**
     * @var string The database table used by the model.
     */
    public $table = 'expedia_expediaimport_properties';
    public $jsonable = ['collections', 'themes', 'hthemes', 'hstatistics', 'hattributes_pets', 'hattributes_general'];
    

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];




    /* Region */

    public function getPropertyRegionNameOptions($value, $formData) {
        //$users = Db::table('users')->get();

        $regions = Db::select( "SELECT id,region_name FROM expedia_expediaimport_region WHERE region_name <> '' ");

        foreach ($regions as $region) {
            //$varcountry[] = $key=>$country->name;
            $mkey[] = $region->region_name;
            $mvalue[] = $region->region_name;
        }

        $farray = array_combine($mkey, $mvalue);
        //print_r($farray);
        return $farray;

    }

    /* Collections */

    public function getCollectionsOptions($value, $formData) {
        //$users = Db::table('users')->get();

        $collections = Db::select( "SELECT id,collection_name FROM expedia_expediaimport_collections WHERE collection_name <> '' ");

        foreach ($collections as $collection) {
            //$varcountry[] = $key=>$country->name;
            $mkey[] = $collection->id;
            $mvalue[] = $collection->collection_name;
        }

        $farray = array_combine($mkey, $mvalue);
        //print_r($farray);
        return $farray;

    }

    /* Themes - Read Only */

    public function getHthemesOptions($value, $formData) {

       
        $recID = $this->id;

        //$recID = 20;

        if(!empty($recID)) {
            $themes = Db::select( "SELECT themes FROM expedia_expediaimport_properties WHERE themes <> '' AND id = $recID");



            // check for no result on query
            if(count($themes) > 0 ) { 
            
                foreach($themes as $nvalue) {
                    $ntheme = $nvalue->themes;
                }

                

                $ntheme = unserialize($ntheme);

                foreach ($ntheme as $nkey => $nvalue) {
                   // echo $nvalue->id . "<br />";

                    $mkey[] = $nvalue->id;
                    $mvalue[] = $nvalue->name;

                }

                $farray = array_combine($mkey, $mvalue);
             } else {

                $farray = array("0"=>"Nothing to display");
                //print_r($statistics);
            }


        } else {
            $themes = Db::select( "SELECT themes FROM expedia_expediaimport_properties WHERE themes <> '' limit 1");


            foreach ($themes as $theme) {
                //$varcountry[] = $key=>$country->name;
                $mkey[] = $theme->themes;
                $mvalue[] = $theme->themes;
            }

             //$farray = array_combine($mkey, $mvalue);
             $farray = array("0"=>"Nothing to display");

        }
  

       
        
        return $farray;

    }



    /* Statistics - Read Only */

    public function getHstatisticsOptions($value, $formData) {

       
        $recID = $this->id;

        //$recID = 20;

        if(!empty($recID)) {
            $statistics = Db::select( "SELECT statistics FROM expedia_expediaimport_properties WHERE statistics <> '' AND id = $recID");



             // check for no result on query
            if(count($statistics) > 0 ) { 

                    foreach($statistics as $nvalue) {
                        $nstatistics = $nvalue->statistics;
                    }

                    

                    $nstatistics = unserialize($nstatistics);

                    foreach ($nstatistics as $nkey => $nvalue) {
                      // echo $nvalue->name . "<br />";

                        $mkey[] = $nvalue->id;
                        $mvalue[] = $nvalue->name;

                    }

                    $farray = array_combine($mkey, $mvalue);

            } else {

                $farray = array("0"=>"Nothing to display");
                //print_r($statistics);
            }


        } else {
            $statistics = Db::select( "SELECT statistics FROM expedia_expediaimport_properties WHERE statistics <> '' limit 1");


            foreach ($statistics as $statistic) {
                //$varcountry[] = $key=>$country->name;
                $mkey[] = $statistic->statistics;
                $mvalue[] = $statistic->statistics;
            }

            //$farray = array_combine($mkey, $mvalue);
             $farray = array("0"=>"Nothing to display");


        }
  

        
        
        return $farray;

    }


     /* Attributes:pets - Read Only */

    public function getHattributesPetsOptions($value, $formData) {

       
        $recID = $this->id;

        //$recID = 20;

        if(!empty($recID)) {
            $statistics = Db::select( "SELECT attributes_pets FROM expedia_expediaimport_properties WHERE attributes_pets <> '' AND id = $recID");


            // check for no result on query
            if(count($statistics) > 0 ) {

                foreach($statistics as $nvalue) {
                    $nstatistics = $nvalue->attributes_pets;
                }

                

                $nstatistics = unserialize($nstatistics);

                foreach ($nstatistics as $nkey => $nvalue) {
                  // echo $nvalue->name . "<br />";

                    $mkey[] = $nvalue->id;
                    $mvalue[] = $nvalue->name;

                }

                $farray = array_combine($mkey, $mvalue);

            } else {

                $farray = array("0"=>"Nothing to display");
                //print_r($statistics);
            }


        } else {
            $statistics = Db::select( "SELECT attributes_pets FROM expedia_expediaimport_properties WHERE attributes_pets <> '' limit 1");


            foreach ($statistics as $statistic) {
                //$varcountry[] = $key=>$country->name;
                $mkey[] = $statistic->attributes_pets;
                $mvalue[] = $statistic->attributes_pets;
            }

             //$farray = array_combine($mkey, $mvalue);
             $farray = array("0"=>"Nothing to display");


        }

        
        return $farray;

    }


    /* Attributes:general - Read Only */

    public function getHattributesGeneralOptions($value, $formData) {

       
        $recID = $this->id;

        //$recID = 20;

        if(!empty($recID)) {

            $statistics = Db::select( "SELECT attributes_general FROM expedia_expediaimport_properties WHERE attributes_general <> '' AND id = $recID");


            // check for no result on query

            if(count($statistics) > 0 ) {

                foreach($statistics as $nvalue) {
                    $nstatistics = $nvalue->attributes_general;
                }


                $nstatistics = unserialize($nstatistics);

                foreach ($nstatistics as $nkey => $nvalue) {
                  // echo $nvalue->name . "<br />";

                    $mkey[] = $nvalue->id;
                    $mvalue[] = $nvalue->name;

                }

                $farray = array_combine($mkey, $mvalue);

            } else {

                $farray = array("0"=>"Nothing to display");
                // print_r($statistics);
            }


        } else {
            $statistics = Db::select( "SELECT attributes_general FROM expedia_expediaimport_properties WHERE attributes_general <> '' limit 1");


            foreach ($statistics as $statistic) {
                //$varcountry[] = $key=>$country->name;
                $mkey[] = $statistic->attributes_general;
                $mvalue[] = $statistic->attributes_general;
            }

             //$farray = array_combine($mkey, $mvalue);
             $farray = array("0"=>"Nothing to display");

        }
   
        
        return $farray;

    }



    // public function action($recordId) {
    //      $this->vars['myId'] = $recordId;

    //      return $recordId;

    // }

    public function beforeUpdate() {
        $recID = $this->id;

        $slugUrl = Input::get('Property.slug');
        //$input = Input::get('products.0.name');

        


        // check duplicate 
        $slugQuery = Db::select( "SELECT slug FROM expedia_expediaimport_properties WHERE slug = '$slugUrl' AND id <> $recID");


        if(!empty($slugUrl)) {
            if(count($slugQuery) > 0 ) {

                \Flash::error('URL already been used.');
               //echo '<p data-control="flash-message" data-interval="5" class="success">This message is created from a static element. It will go away in 5 seconds.</p>';
                Log::info('URL already been used - '. $slugUrl);

                //return Redirect::refresh();
                //return false;
                throw new ValidationException([$slugUrl => 'Sorry that URL is already taken!']);
                return false; 
                //return Redirect::back();

            } else {
                Log::info('Property Updated with ID:'. $recID);
            }
        } else {
            Log::info('Empty URL - '. $slugUrl);
            return;
        }

        
        /*foreach($slugQuery as $value) {
            //$slugName = $value->name;
            $slugUrl = $value->slug;
        }*/



    }


    // apply initial value 
    public function getSlugAttribute() {

        $recID = $this->id;
        $slugURL = "";

        if(!empty($recID)) {
        $slugQuery = Db::select( "SELECT name, slug FROM expedia_expediaimport_properties WHERE id = $recID");

        foreach($slugQuery as $value) {
            $slugName = $value->name;
            $slugUrl = $value->slug;
        }


         // for testing 
        //$slugOldName = $slugName;

        
        $slugName = str_replace(' ', '-', $slugName); // Replaces all spaces with hyphens.
        $slugName = preg_replace('/[^A-Za-z0-9\-]/', '', $slugName); // Removes special chars.
        $slugName =  preg_replace('/-+/', '-', $slugName); // Replaces multiple hyphens with single one.
        

       
        //$slugValue = $slugQuery['name'];

        //print_r($slugUrl);

        // convert to lowercase and strip spaces
        //$slugName = strtolower(trim($slugName));

        //convert spaces to dash
        //$slugName = str_replace(" ", "-", $slugName);

        //$slugName = clean($slugName);

        if (empty($slugUrl)) {
            return strtolower($slugName);
        } else {
            return $slugUrl;
        }

        //return $slugURL;
        } // not empty 
    }



    public function afterDelete() {
        $recID = $this->id;
        $property_id = $this->property_id;
        //$property_id  = Input::get('property_id');
        //$property_id  = Input::get('Property.property_id');

        // this is to make sure that deleted property will also be deleted from other tables

        $deleted_rooms = Db::delete("delete from expedia_expediaimport_rooms where property_id = " . $property_id);
        $deleted_amenities = Db::delete("delete from expedia_expediaimport_amenities where property_id = " . $property_id);
        $deleted_room_amenities = Db::delete("delete from expedia_expediaimport_room_amenities where property_id = " . $property_id);
        $deleted_room_bed_groups = Db::delete("delete from expedia_expediaimport_room_bed_groups where property_id = " . $property_id);
        $deleted_ratings = Db::delete("delete from expedia_expediaimport_ratings where property_id = " . $property_id);
        $deleted_images = Db::delete("delete from expedia_expediaimport_images where property_id = " . $property_id);

        Log::info('deleted a record - '. $property_id);

    }



    /* relations for image */

    public $attachMany = [
        'test' => ['System\Models\File', 'order' => 'sort_order']
    ];
}
