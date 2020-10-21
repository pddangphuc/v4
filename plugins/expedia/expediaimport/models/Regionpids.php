<?php namespace Expedia\ExpediaImport\Models;

use Model;

/**
 * Model
 */
class Regionpids extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'expedia_expediaimport_region_pids';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
