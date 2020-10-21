<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateViewretreatsLandingpages extends Migration
{
    public function up()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->string('title_description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->dropColumn('title_description');
        });
    }
}