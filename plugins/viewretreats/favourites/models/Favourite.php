<?php namespace ViewRetreats\Favourites\Models;

use Model;

/**
 * Model
 */
class Favourite extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'viewretreats_favourites_list';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
