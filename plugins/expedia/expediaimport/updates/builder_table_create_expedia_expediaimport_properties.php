<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportProperties extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_properties', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('property_id');
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_properties');
    }
}
