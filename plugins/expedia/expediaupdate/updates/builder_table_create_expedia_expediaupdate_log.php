<?php namespace Expedia\ExpediaUpdate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateExpediaExpediaupdateLog extends Migration
{
    public function up()
    {
        Schema::create('expedia_expediaupdate_log', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('property_id')->nullable();
            $table->dateTime('property_updated')->nullable();
            $table->boolean('name_changed')->default(0);
            $table->boolean('images_changed')->default(0);
            $table->integer('images_count')->nullable()->default(0);
            $table->string('images_links')->nullable();
            $table->boolean('other_changed')->nullable();
            $table->string('status')->nullable();
            $table->string('level')->nullable();
            $table->text('message')->nullable();
            $table->text('details')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('actioned')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expedia_expediaupdate_log');
    }
}
