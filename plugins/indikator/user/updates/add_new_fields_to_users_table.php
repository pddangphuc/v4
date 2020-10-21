<?php namespace Indikator\User\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddNewFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('iu_tel_code', 100)->nullable();
            $table->string('iu_telephone', 100)->nullable();
            $table->string('iu_telephone_full', 100)->nullable();
            $table->string('iu_company', 100)->nullable();
            $table->string('iu_address')->nullable();
            $table->string('iu_city')->nullable();
            $table->string('iu_country_code', 100)->nullable();
            $table->string('iu_country')->nullable();
            $table->string('iu_state')->nullable();
            $table->string('iu_postcode')->nullable();
            $table->boolean('iu_email_newsletter')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn(['iu_telephone', 'iu_tel_code', 'iu_telephone_full', 'iu_country_code', 'iu_company', 'iu_address', 'iu_city', 'iu_country', 'iu_state','iu_postcode', 'iu_email_newsletter']);
        });
    }
}
