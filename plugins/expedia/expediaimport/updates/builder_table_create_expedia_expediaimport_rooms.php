<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRooms extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_rooms', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('room_name')->nullable();
            $table->text('room_description');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_rooms');
    }
}