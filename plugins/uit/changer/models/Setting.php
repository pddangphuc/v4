<?php namespace Uit\Changer\Models;


use Model;
use Cache;

/**
 * Setting Model
 */
class Setting extends Model
{

    public $menuItems;
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'uit_changer_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';





    public function getMenuOptions()
    {
        $menuItems = Cache::get('backend_menu_items',[]);
        return $menuItems;
    }



}
