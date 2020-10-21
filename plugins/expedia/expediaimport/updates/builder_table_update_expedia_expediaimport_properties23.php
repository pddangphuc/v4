<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties23 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('chkin_hour', 191)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('chkin_hour')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}