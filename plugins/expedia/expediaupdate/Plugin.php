<?php namespace Expedia\ExpediaUpdate;

use System\Classes\PluginBase;
use Expedia\ExpediaUpdate\Classes\Updater;
use Db;


class Plugin extends PluginBase
{
    
    public function pluginDetails()
    {
        return [
            'name' => 'Expedia Auto Update',
            'description' => 'Update all properties from Expedia',
            'author' => 'Mike Suarez',
            'icon' => 'icon-check-circle-o'
        ];
    }


    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }


    public function boot() {

    /*\Log::debug("plugin log!");*/
    
    }

    public function register() {
	
	      
    
    }

    public function registerSchedule($schedule) {
        $schedule->call(function () {
            $records = Updater::checkUpdates();
        })->weekly()->wednesdays()->at('12:00');
    }

   /* public function registerSchedule($schedule) {
        $schedule->call(function () {
            $records = Updater::doTest();
        })->everyMinute();
    }
	*/
   
}
