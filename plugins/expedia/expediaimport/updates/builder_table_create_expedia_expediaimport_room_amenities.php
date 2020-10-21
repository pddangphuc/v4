<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRoomAmenities extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_room_amenities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('amenities_id')->nullable();
            $table->string('amenities_name')->nullable();
            $table->string('amenities_value')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_room_amenities');
    }
}