<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRegion extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_region', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('region_name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_region');
    }
}
