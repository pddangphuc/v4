<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportRegions extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_regions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('region_id')->nullable();
            $table->string('region_type', 50)->nullable();
            $table->string('region_name', 255)->nullable();
            $table->string('region_name_full', 510)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('descriptor', 50)->nullable();
            $table->decimal('longitude', 10, 0)->nullable();
            $table->decimal('latitude', 10, 0)->nullable();
            $table->text('point_of_interest')->nullable();
            $table->text('ancestors')->nullable();
            $table->text('property_ids')->nullable();
            $table->text('property_ids_expanded')->nullable();
            $table->text('descendants')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_regions');
    }
}