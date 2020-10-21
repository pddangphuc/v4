<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties7 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('slug')->change();
            $table->string('zoho_id')->change();
            $table->string('region_name')->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('slug', 191)->change();
            $table->string('zoho_id', 191)->change();
            $table->string('region_name', 191)->change();
        });
    }
}
