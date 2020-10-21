<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties14 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->renameColumn('region_id', 'property_region_id');
            $table->renameColumn('region_name', 'property_region_name');
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->renameColumn('property_region_id', 'region_id');
            $table->renameColumn('property_region_name', 'region_name');
        });
    }
}
