<?php namespace ViewRetreats\LandingPages\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Db;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Storage;
use Expedia\Api\Models\Settings;

class Landing extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ViewRetreats.LandingPages', 'main-menu-landing');
    }


    
    public function onLandingSaveClose($id = null)
    {
        $data = post();

        // Check storage/logs/system.log
        //trace_log($data);


        $lname = $data['Landing']['name'];
        $lurl_temp = $data['Landing']['url_temp'];

        //$lslug = $data['Landing']['slug'];
        $ltitle_description = $data['Landing']['title_description'];
        $lprop_title = $data['Landing']['prop_title'];
        $ldescription = $data['Landing']['description'];
        $lslider_id = $data['Landing']['slider_id'];
        $lcarousel_id = $data['Landing']['carousel_id'];
        $lactive = $data['Landing']['active'];
        $lmeta_title = $data['Landing']['meta_title'];
        $lrobot_index = $data['Landing']['robot_index'];
        $lmeta_desc = $data['Landing']['meta_desc'];
        $lmore_link = $data['Landing']['more_link'];
        $lproperty_ids = $data['Landing']['property_ids'];
        

		// check if active or inactive to disable slug 

        if ($lactive == 0) {

        	$lslug = '';

        } else {

        	$lslug = $lurl_temp;
        }


        Db::table('viewretreats_landingpages_')->updateOrInsert(['id' => $id],[
	 		'name' => $lname,
	        'url_temp' => $lurl_temp,
	        'slug' => $lslug,
            'prop_title' => $lprop_title,
	        'title_description' => $ltitle_description,
	        'description' => $ldescription,
	        'slider_id' => $lslider_id,
	        'carousel_id' => $lcarousel_id,
	        'active' => $lactive,
	        'meta_title' => $lmeta_title,
	        'robot_index' => $lrobot_index,
	        'meta_desc' => $lmeta_desc,
	        'more_link' => $lmore_link,
	        'property_ids' => $lproperty_ids
        ]);
        

        \Flash::success('Landing Page Saved');

        // Return a redirect
         return \Backend::redirect('viewretreats/landingpages/landing');
        //return \Redirect::refresh();        

    } // onCreateandclose



    public function onLandingSave($id = null)
    {
        $data = post();

        // Check storage/logs/system.log
        //trace_log($data);


        $lname = $data['Landing']['name'];
        $lurl_temp = $data['Landing']['url_temp'];
        //$lslug = $data['Landing']['slug'];
        $ltitle_description = $data['Landing']['title_description'];
        $lprop_title = $data['Landing']['prop_title'];
        $ldescription = $data['Landing']['description'];
        $lslider_id = $data['Landing']['slider_id'];
        $lcarousel_id = $data['Landing']['carousel_id'];
        $lactive = $data['Landing']['active'];
        $lmeta_title = $data['Landing']['meta_title'];
        $lrobot_index = $data['Landing']['robot_index'];
        $lmeta_desc = $data['Landing']['meta_desc'];
        $lmore_link = $data['Landing']['more_link'];
        $lproperty_ids = $data['Landing']['property_ids'];
        

		// check if active or inactive to disable slug 

        if ($lactive == 0) {

        	$lslug = '';

        } else {

        	$lslug = $lurl_temp;
        }


        Db::table('viewretreats_landingpages_')->updateOrInsert(['id' => $id],[
	 		'name' => $lname,
	        'url_temp' => $lurl_temp,
	        'slug' => $lslug,
            'prop_title' => $lprop_title,
	        'title_description' => $ltitle_description,
	        'description' => $ldescription,
	        'slider_id' => $lslider_id,
	        'carousel_id' => $lcarousel_id,
	        'active' => $lactive,
	        'meta_title' => $lmeta_title,
	        'robot_index' => $lrobot_index,
	        'meta_desc' => $lmeta_desc,
	        'more_link' => $lmore_link,
	        'property_ids' => $lproperty_ids
        ]);
        

        \Flash::success('Landing Page Saved');

        // Return a redirect
         //return \Backend::redirect('viewretreats/landingpages/landing');
        //return \Redirect::refresh();        

    } // onCreate

}
