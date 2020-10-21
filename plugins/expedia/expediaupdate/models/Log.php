<?php namespace Expedia\ExpediaUpdate\Models;

use Model;

/**
 * Model
 */
class Log extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'expedia_expediaupdate_log';

    public $timestamps = true;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}


