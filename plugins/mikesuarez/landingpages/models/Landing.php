<?php namespace MikeSuarez\LandingPages\Models;

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


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mikesuarez_landingpages_tbl';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['filter_collection', 'filter_amenities'];


}
