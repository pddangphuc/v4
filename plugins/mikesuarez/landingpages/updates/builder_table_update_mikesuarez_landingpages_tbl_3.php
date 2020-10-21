<?php namespace MikeSuarez\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMikesuarezLandingpagesTbl3 extends Migration
{
    public function up()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->string('filter_accommodation', 191)->nullable()->change();
            $table->text('filter_amenities')->nullable()->change();
            $table->string('filter_child', 191)->nullable()->change();
            $table->text('filter_collection')->nullable()->change();
            $table->string('filter_country', 191)->nullable()->change();
            $table->string('filter_featured', 191)->nullable()->change();
            $table->string('filter_pets', 191)->nullable()->change();
            $table->string('filter_region', 191)->nullable()->change();
            $table->string('filter_sole', 191)->nullable()->change();
            $table->string('filter_state', 191)->nullable()->change();
            $table->string('landing_slug', 191)->nullable()->change();
            $table->string('landing_title', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->string('filter_accommodation', 191)->nullable(false)->change();
            $table->text('filter_amenities')->nullable(false)->change();
            $table->string('filter_child', 191)->nullable(false)->change();
            $table->text('filter_collection')->nullable(false)->change();
            $table->string('filter_country', 191)->nullable(false)->change();
            $table->string('filter_featured', 191)->nullable(false)->change();
            $table->string('filter_pets', 191)->nullable(false)->change();
            $table->string('filter_region', 191)->nullable(false)->change();
            $table->string('filter_sole', 191)->nullable(false)->change();
            $table->string('filter_state', 191)->nullable(false)->change();
            $table->string('landing_slug', 191)->nullable(false)->change();
            $table->string('landing_title', 191)->nullable(false)->change();
        });
    }
}
