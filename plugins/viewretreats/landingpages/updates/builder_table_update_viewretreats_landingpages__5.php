<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateViewretreatsLandingpages5 extends Migration
{
    public function up()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->boolean('robot_follow')->default(1);
            $table->string('robot_advance', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->dropColumn('robot_follow');
            $table->dropColumn('robot_advance');
        });
    }
}