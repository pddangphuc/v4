<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateViewretreatsLandingpages2 extends Migration
{
    public function up()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->string('more_link')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->dropColumn('more_link');
        });
    }
}
