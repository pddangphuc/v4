<?php namespace ViewRetreats\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateViewretreatsLandingpages extends Migration
{
    public function up()
    {
        Schema::create('viewretreats_landingpages_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('slider_id')->nullable();
            $table->string('carousel_id')->nullable();
            $table->string('property_ids')->nullable();
            $table->string('theme')->nullable();
            $table->boolean('active')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('viewretreats_landingpages_');
    }
}