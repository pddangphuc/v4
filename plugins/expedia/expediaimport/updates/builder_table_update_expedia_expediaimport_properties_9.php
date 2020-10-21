<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties9 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->renameColumn('desc_location', 'desc_locations');
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->renameColumn('desc_locations', 'desc_location');
        });
    }
}