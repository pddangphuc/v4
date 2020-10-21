<?php namespace Rjchauhan\LightGallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateImageGalleriesTable extends Migration
{

    public function up()
    {
        Schema::create('rjchauhan_lightgallery_image_galleries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rjchauhan_lightgallery_image_galleries');
    }

}
