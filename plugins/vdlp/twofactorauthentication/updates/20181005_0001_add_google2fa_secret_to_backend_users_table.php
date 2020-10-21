<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Updates;

use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

/** @noinspection AutoloadingIssuesInspection */

/**
 * Class AddGoogle2FaSecretToBackendUsersTable
 *
 * @package Vdlp\TwoFactorAuthentication\Updates
 */
class AddGoogle2FaSecretToBackendUsersTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table('backend_users', function (Blueprint $table) {
            $table->text('vdlp-twofactorauthentication_google2fa_secret')
                ->after('password')
                ->nullable();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('backend_users', function (Blueprint $table) {
            $table->dropColumn('vdlp-twofactorauthentication_google2fa_secret');
        });
    }
}
