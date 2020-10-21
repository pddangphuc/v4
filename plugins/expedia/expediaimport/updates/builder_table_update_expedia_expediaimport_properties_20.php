<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties20 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('attributes_pets')->nullable();
            $table->text('hattributes_pets')->nullable();
            $table->text('attributes_general')->nullable();
            $table->text('hattributes_general')->nullable();
            $table->dropColumn('attributes');
            $table->dropColumn('hattributes');
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('attributes_pets');
            $table->dropColumn('hattributes_pets');
            $table->dropColumn('attributes_general');
            $table->dropColumn('hattributes_general');
            $table->text('attributes')->nullable();
            $table->text('hattributes')->nullable();
        });
    }
}
