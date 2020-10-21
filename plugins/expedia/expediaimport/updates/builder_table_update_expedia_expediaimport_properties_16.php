<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties16 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('themes')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('themes');
        });
    }
}
