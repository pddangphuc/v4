<?php namespace MikeSuarez\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMikesuarezLandingpagesTbl extends Migration
{
    public function up()
    {
        Schema::create('mikesuarez_landingpages_tbl', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('page_type');
            $table->string('filter_featured');
            $table->string('filter_country');
            $table->string('filter_state');
            $table->string('filter_region');
            $table->string('filter_accommodation');
            $table->text('filter_collection');
            $table->text('filter_amenities');
            $table->string('filter_child');
            $table->string('filter_pets');
            $table->string('filter_sole');
            $table->string('landing_title');
            $table->string('landing_slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mikesuarez_landingpages_tbl');
    }
}
