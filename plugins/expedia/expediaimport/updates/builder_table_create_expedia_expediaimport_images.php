<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaimportImages extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaimport_images', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('caption')->nullable();
            $table->boolean('hero_image')->nullable();
            $table->string('category')->nullable();
            $table->text('links')->nullable();
            $table->text('links_thumb')->nullable();
            $table->text('links_small')->nullable();
            $table->text('links_large')->nullable();
            $table->string('links_thumb_sort_id')->nullable();
            $table->string('links_small_sort_id')->nullable();
            $table->string('links_large_sort_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaimport_images');
    }
}