<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties30 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('meta_title', 60)->nullable();
            $table->string('meta_desc', 160)->nullable();
            $table->boolean('robot_index')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_desc');
            $table->dropColumn('robot_index');
        });
    }
}