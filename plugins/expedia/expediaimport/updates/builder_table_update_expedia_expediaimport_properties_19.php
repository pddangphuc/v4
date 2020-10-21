<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties19 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('attributes')->nullable();
            $table->text('hattributes')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('attributes');
            $table->dropColumn('hattributes');
        });
    }
}
