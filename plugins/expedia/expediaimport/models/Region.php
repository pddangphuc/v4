<?php namespace Expedia\ExpediaImport\Models;

use Model;

/**
 * Model
 */
class Region extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'expedia_expediaimport_region';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
