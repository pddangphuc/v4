<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRegionPids extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_region_pids', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('region_id')->nullable();
            $table->string('property_ids')->nullable();
            $table->string('property_ids_exp')->nullable();
            $table->boolean('linked')->nullable()->default(0);
            $table->string('sort_order')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_region_pids');
    }
}