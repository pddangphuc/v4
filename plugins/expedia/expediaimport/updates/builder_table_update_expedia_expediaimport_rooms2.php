<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRooms2 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->string('room_occupancy_max_allowed', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->string('room_occupancy_max_allowed', 191)->nullable(false)->change();
        });
    }
}