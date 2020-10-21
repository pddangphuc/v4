<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportImages2 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_images', function($table)
        {
            $table->integer('poster')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_images', function($table)
        {
            $table->integer('poster')->default(null)->change();
        });
    }
}
