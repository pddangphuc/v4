<?php namespace MikeSuarez\LandingPages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMikesuarezLandingpagesTbl2 extends Migration
{
    public function up()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->dropColumn('page_type');
        });
    }
    
    public function down()
    {
        Schema::table('mikesuarez_landingpages_tbl', function($table)
        {
            $table->string('page_type', 191);
        });
    }
}
