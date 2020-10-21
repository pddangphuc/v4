<?php namespace MikeSuarez\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMikesuarezLandingpagesTbl extends Migration
{
    public function up()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
