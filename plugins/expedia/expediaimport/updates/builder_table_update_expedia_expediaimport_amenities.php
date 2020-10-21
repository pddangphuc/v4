<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportAmenities extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_amenities', function($table)
        {
            $table->string('amenities_name', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_amenities', function($table)
        {
            $table->text('amenities_name')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}