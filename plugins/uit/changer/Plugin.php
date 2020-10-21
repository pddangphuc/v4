<?php namespace Uit\Changer;

use System\Classes\PluginBase;
use Uit\Changer\Models\Setting;
use Backend;
use Cache;

/**
 * changer Plugin Information File
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
            'name' => 'uit.changer::lang.plugin.name',
            'description' => 'uit.changer::lang.plugin.description',
            'author' => 'uit',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $settings = Setting::instance();

        \Event::listen('backend.menu.extendItems', function ($manager) use ($settings) {
            

            if (!Cache::has('backend_menu_items')) {
                $menuItems = [];
                foreach($manager->listMainMenuItems() as $key => $item) {
                    $menuItems[$key] = $item->label;
                }
                Cache::put('backend_menu_items', $menuItems, 50);
               
            }

          
            foreach ($manager->listMainMenuItems() as $key => $item) {

                if(is_array($settings->get('menu_items'))){
                    foreach ($settings->get('menu_items') as $newItem) {

                        if ($key == $newItem['menu']) {

                            $item->label = !empty(trim($newItem['label'])) ? $newItem['label'] : $item->label;
                            $item->iconSvg = trim($newItem['iconSvg']) != '' ? $newItem['iconSvg'] : $item->iconSvg;
                            $item->icon = trim($newItem['icon']) != '' ? $newItem['icon'] : $item->icon;

                        }

                    }
                }

            }

        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Uit\Changer\Components\MyComponent' => 'myComponent',
        ];
    }


    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'uit.changer::lang.plugin.name',
                'description' => 'uit.changer::lang.plugin.description',
                'category' => 'system::lang.system.categories.system',
                'icon' => 'icon-bars',
                'class' => 'Uit\Changer\Models\Setting',
                'order' => 500,
                'keywords' => '',
                'permissions' => ['uit.changer.manage_plugins'],
            ]
        ];
    }


    public function registerPermissions()
    {
        return [
            'uit.changer.manage_plugins' => [
                'tab' => 'uit.changer::lang.plugin.name',
                'label' => 'uit.changer::lang.plugin.description']
        ];
    }

}
