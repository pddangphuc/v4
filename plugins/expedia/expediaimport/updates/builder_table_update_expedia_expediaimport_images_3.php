<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportImages3 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_images', function($table)
        {
            $table->boolean('updated')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_images', function($table)
        {
            $table->dropColumn('updated');
        });
    }
}
