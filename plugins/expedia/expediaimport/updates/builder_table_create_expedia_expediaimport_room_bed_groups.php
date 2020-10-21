<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRoomBedGroups extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_room_bed_groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('bed_groups_id')->nullable();
            $table->text('description')->nullable();
            $table->text('configuration')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_room_bed_groups');
    }
}