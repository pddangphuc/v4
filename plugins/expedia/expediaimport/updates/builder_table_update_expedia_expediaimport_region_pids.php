<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRegionPids extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_region_pids', function($table)
        {
            $table->string('region_parent')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_region_pids', function($table)
        {
            $table->dropColumn('region_parent');
        });
    }
}