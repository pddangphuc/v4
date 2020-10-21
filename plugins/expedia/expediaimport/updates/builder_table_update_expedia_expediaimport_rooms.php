<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRooms extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->string('room_area')->nullable();
            $table->string('room_views')->nullable();
            $table->string('room_occupancy_max_allowed');
            $table->text('room_occupancy_age_categories')->nullable();
            $table->text('room_description')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->dropColumn('room_area');
            $table->dropColumn('room_views');
            $table->dropColumn('room_occupancy_max_allowed');
            $table->dropColumn('room_occupancy_age_categories');
            $table->text('room_description')->nullable(false)->change();
        });
    }
}