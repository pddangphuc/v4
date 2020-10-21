<?php namespace Expedia\ExpediaUpdate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration103 extends Migration
{
    public function up()
    {
        // Schema::create('expedia_expediaupdate_table', function($table)
        // {
        // });
        
        Schema::table('expedia_expediaupdate_log', function ($table) {
                $table->softDeletes();
        });
    }

    public function down()
    {
        // Schema::drop('expedia_expediaupdate_table');
    }
}