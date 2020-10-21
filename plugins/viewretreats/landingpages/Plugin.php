<?php namespace ViewRetreats\LandingPages;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {

    	return [

    		'ViewRetreats\LandingPages\Components\LandingPages' => 'landingpages'

    	];

    }

    public function registerSettings()
    {


    }
}
