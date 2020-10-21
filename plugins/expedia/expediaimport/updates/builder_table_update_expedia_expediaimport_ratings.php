<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportRatings extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_ratings', function($table)
        {
            $table->string('property_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_ratings', function($table)
        {
            $table->dropColumn('property_id');
        });
    }
}