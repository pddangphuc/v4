<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportAmenities extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_amenities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_id')->nullable();
            $table->string('amenities_id')->nullable();
            $table->text('amenities_name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_amenities');
    }
}