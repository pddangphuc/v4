<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRooms2 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->text('room_views')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_rooms', function($table)
        {
            $table->string('room_views', 191)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
