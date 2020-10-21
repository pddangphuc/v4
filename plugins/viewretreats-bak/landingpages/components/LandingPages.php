<?php namespace Viewretreats\Landingpages\Components;


use Cms\Classes\ComponentBase;

use Viewretreats\Landingpages\Models\Landing;



class LandingPages extends ComponentBase {



	public function componentDetails() {

		return [
			'name' => 'Landing Page Lists',
			'description' => 'List all the landing pages'
		];

	}


	public function onRun() {

		$this->landingpages = $this->loadLandingpages();


	}

	protected function loadLandingpages() {

		$landingSlug = $this->param('slug');

		// return [

		// 	'landingItems' => [
		// 		'slug' => mysql_real_escape_string($this->param('slug')), 
		// 		'name' => 'sample'

		// 	]

		// ];

		//return $this->param('slug');

		return Landing::where('slug', '=', $landingSlug)->get();

		//return $landingSlug;
	}



	public $landingpages;


}


