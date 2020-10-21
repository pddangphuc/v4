<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportAmenities2 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_amenities', function($table)
        {
            $table->string('amenities_value')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_amenities', function($table)
        {
            $table->dropColumn('amenities_value');
        });
    }
}