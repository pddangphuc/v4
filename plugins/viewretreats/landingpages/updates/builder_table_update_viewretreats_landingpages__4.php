<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateViewretreatsLandingpages4 extends Migration
{
    public function up()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->string('url_temp', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('viewretreats_landingpages_', function($table)
        {
            $table->dropColumn('url_temp');
        });
    }
}
