<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties12 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('chkin_special_instructions')->nullable()->change();
            $table->text('fees_optional')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('chkin_special_instructions')->nullable(false)->change();
            $table->text('fees_optional')->nullable(false)->change();
        });
    }
}
