<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRatings extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_ratings', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_rating')->nullable();
            $table->string('property_rating_type', 20)->nullable();
            $table->integer('guest_count')->nullable();
            $table->string('guest_overall')->nullable();
            $table->string('guest_cleanliness')->nullable();
            $table->string('guest_service')->nullable();
            $table->string('guest_comfort')->nullable();
            $table->string('guest_condition')->nullable();
            $table->string('guest_location')->nullable();
            $table->string('guest_neighborhood')->nullable();
            $table->string('guest_quality')->nullable();
            $table->string('guest_value')->nullable();
            $table->string('guest_amenities')->nullable();
            $table->string('guest_recommendation_percent')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_ratings');
    }
}