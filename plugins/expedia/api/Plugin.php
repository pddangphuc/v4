<?php namespace Expedia\Api;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Expedia API',
            'description' => 'Manage API settings.',
            'author' => 'Mike Suarez',
            'icon' => 'icon-key'
        ];
    }


    public function registerComponents()
    {
    }


    public function registerSettings()
	{
	    return [
	        'settings' => [
	            'label'       => 'Expedia API',
	            'description' => 'Manage API settings.',
	            'category' 	  => 'system::lang.system.categories.system',
	            'icon'        => 'icon-key',
	            'class'       => 'Expedia\Api\Models\Settings',
	            'author' 	  => 'Mike Suarez',
	            'order'       => 500,
	            'keywords'    => 'api settings',
	            'permissions' => ['expedia.api.expedia_api_settings']
	        ]
	    ];
	}
}
