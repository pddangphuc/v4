<?php namespace ViewRetreats\Favourites\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateViewretreatsFavouritesList extends Migration
{
    public function up()
    {
        Schema::create('viewretreats_favourites_list', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('viewretreats_favourites_list');
    }
}
