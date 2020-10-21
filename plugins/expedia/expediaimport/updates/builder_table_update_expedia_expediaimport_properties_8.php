<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties8 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->text('desc_amenities')->nullable();
            $table->text('desc_dining')->nullable();
            $table->text('desc_renovations')->nullable();
            $table->text('desc_buss_amenities')->nullable();
            $table->text('desc_rooms')->nullable();
            $table->text('desc_attractions')->nullable();
            $table->text('desc_location')->nullable();
            $table->text('desc_headline')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('desc_amenities');
            $table->dropColumn('desc_dining');
            $table->dropColumn('desc_renovations');
            $table->dropColumn('desc_buss_amenities');
            $table->dropColumn('desc_rooms');
            $table->dropColumn('desc_attractions');
            $table->dropColumn('desc_location');
            $table->dropColumn('desc_headline');
        });
    }
}
