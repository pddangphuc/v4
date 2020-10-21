<?php namespace Expedia\Api\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'expedia_api_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}