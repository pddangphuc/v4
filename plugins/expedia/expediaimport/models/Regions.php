<?php namespace Expedia\ExpediaImport\Models;

use Model;

/**
 * Model
 */
class Regions extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'expedia_expediaimport_regions';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
