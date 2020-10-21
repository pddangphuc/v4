<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties6 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('slug')->nullable();
            $table->boolean('active')->default(0);
            $table->string('zoho_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('region_name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('slug');
            $table->dropColumn('active');
            $table->dropColumn('zoho_id');
            $table->dropColumn('region_id');
            $table->dropColumn('region_name');
        });
    }
}
