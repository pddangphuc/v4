<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties22 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->boolean('inc_all_rate_plans')->default(0);
            $table->boolean('inc_some_rate_plans')->default(0);
            $table->text('inc_details')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('inc_all_rate_plans');
            $table->dropColumn('inc_some_rate_plans');
            $table->dropColumn('inc_details');
        });
    }
}
