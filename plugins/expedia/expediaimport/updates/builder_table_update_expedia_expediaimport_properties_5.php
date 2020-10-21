<?php namespace Expedia\ExpediaImport\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateExpediaExpediaimportProperties5 extends Migration
{
    public function up()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->bigInteger('rank')->nullable();
            $table->boolean('expedia_collect')->default(1);
            $table->boolean('property_collect')->default(1);
            $table->string('chkin_begin_time')->nullable();
            $table->string('chkin_end_time')->nullable();
            $table->text('chkin_instructions')->nullable();
            $table->text('chkin_special_instructions');
            $table->integer('chkin_min_age')->nullable();
            $table->string('chkout_time')->nullable();
            $table->text('fees_optional');
            $table->text('policies_before_you_go')->nullable();
            $table->string('dates_added')->nullable();
            $table->string('dates_updated')->nullable();
            $table->string('airport_code')->nullable();
            $table->string('chain_id')->nullable();
            $table->string('chain_name')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('brand_name')->nullable();
            $table->boolean('multi_unit')->default(0);
            $table->boolean('pay_reg_recommended')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('expedia_expediaimport_properties', function($table)
        {
            $table->dropColumn('phone');
            $table->dropColumn('fax');
            $table->dropColumn('category_id');
            $table->dropColumn('category_name');
            $table->dropColumn('rank');
            $table->dropColumn('expedia_collect');
            $table->dropColumn('property_collect');
            $table->dropColumn('chkin_begin_time');
            $table->dropColumn('chkin_end_time');
            $table->dropColumn('chkin_instructions');
            $table->dropColumn('chkin_special_instructions');
            $table->dropColumn('chkin_min_age');
            $table->dropColumn('chkout_time');
            $table->dropColumn('fees_optional');
            $table->dropColumn('policies_before_you_go');
            $table->dropColumn('dates_added');
            $table->dropColumn('dates_updated');
            $table->dropColumn('airport_code');
            $table->dropColumn('chain_id');
            $table->dropColumn('chain_name');
            $table->dropColumn('brand_id');
            $table->dropColumn('brand_name');
            $table->dropColumn('multi_unit');
            $table->dropColumn('pay_reg_recommended');
        });
    }
}
