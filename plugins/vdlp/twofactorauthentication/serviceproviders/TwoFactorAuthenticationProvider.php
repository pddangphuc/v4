<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\ServiceProviders;

use Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication\GoogleTwoFactorAuthentication;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication\SecretKey;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication\TwoFactorAuthentication;
use Illuminate\Contracts\Encryption\Encrypter;
use October\Rain\Support\ServiceProvider;
use PragmaRX\Google2FA\Google2FA;

/**
 * Class TwoFactorAuthenticationProvider
 *
 * @package Vdlp\TwoFactorAuthentication\ServiceProviders
 */
class TwoFactorAuthenticationProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(GoogleTwoFactorAuthentication::class, function () {
            return new GoogleTwoFactorAuthentication(new Google2FA());
        });

        $this->app->bind(SecretKey::class, function () {
            return new SecretKey(resolve(Encrypter::class));
        });

        $this->app->alias(GoogleTwoFactorAuthentication::class, TwoFactorAuthentication::class);
    }
}
