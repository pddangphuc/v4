<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRegion2 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_region', function($table)
        {
            $table->dropColumn('deleted_at');
        });
    }
}
