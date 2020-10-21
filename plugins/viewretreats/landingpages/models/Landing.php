<?php namespace ViewRetreats\LandingPages\Models;

use Model;

/**
 * Model
 */
class Landing extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;
    //public $jsonable = ['property_ids'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'viewretreats_landingpages_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];



}
