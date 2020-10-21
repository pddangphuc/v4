<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties3 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('property_id', 10)->nullable()->change();
            $table->string('name', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('property_id', 10)->nullable(false)->change();
            $table->string('name', 191)->nullable(false)->change();
        });
    }
}
