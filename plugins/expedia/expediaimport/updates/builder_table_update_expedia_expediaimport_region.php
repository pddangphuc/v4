<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRegion extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->renameColumn('id', 'region_id');
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->renameColumn('region_id', 'id');
        });
    }
}
