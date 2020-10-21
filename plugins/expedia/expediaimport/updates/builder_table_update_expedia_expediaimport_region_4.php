<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRegion4 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->string('region_name', 191)->nullable(false)->default('null')->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->string('region_name', 191)->nullable()->default(null)->change();
        });
    }
}
