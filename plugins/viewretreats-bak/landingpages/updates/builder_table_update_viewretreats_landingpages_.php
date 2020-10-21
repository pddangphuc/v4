<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateViewretreatsLandingpages extends Migration
{
    public function up()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->boolean('robot_index')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->dropColumn('robot_index');
        });
    }
}
