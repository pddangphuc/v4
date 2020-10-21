<?php namespace Expedia\ExpediaImport;

use System\Classes\PluginBase;
use Expedia\ExpediaImport\Classes\Updater;
use Db;
use Model;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }


    public function boot() {

    
    }


	/*public function registerSchedule($schedule) {
        $schedule->call(function () {
            $records = Updater::checkTest();
        })->weekly()->wednesdays()->at('8:35');
    }*/	


    public function registerSchedule($schedule) {
        $schedule->call(function () {
            $records = Updater::checkRegions();
        })->weekly()->tuesdays()->at('12:00');
    }
}
