<?php namespace Rjchauhan\LightGallery;

use Backend;
use System\Classes\PluginBase;

/**
 * LightGallery Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Light Gallery',
            'description' => 'Provides fully customizable and responsive galleries.',
            'author'      => 'Raviraj Chauhan',
            'icon'        => 'icon-picture-o'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Rjchauhan\LightGallery\Components\ImageGallery' => 'imageGallery',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'rjchauhan.lightgallery.some_permission' => [
                'tab' => 'LightGallery',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'lightgallery' => [
                'label'       => 'Light Gallery',
                'url'         => Backend::url('rjchauhan/lightgallery/imagegalleries'),
                'icon'        => 'icon-picture-o',
                'permissions' => ['rjchauhan.lightgallery.*'],
                'order'       => 500,
            ],
        ];
    }

}
