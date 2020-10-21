<?php namespace Expedia\ExpediaUpdate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaupdateLog extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaupdate_log', function($table)
        {
            $table->string('property_name')->nullable();
            $table->string('change_type')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaupdate_log', function($table)
        {
            $table->dropColumn('property_name');
            $table->dropColumn('change_type');
        });
    }
}
