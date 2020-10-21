<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication;

use Endroid\QrCode\QrCode;
use PragmaRX\Google2FA\Google2FA;

/**
 * Class GoogleTwoFactorAuthentication
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication
 */
class GoogleTwoFactorAuthentication implements TwoFactorAuthentication
{
    /**
     * @var Google2FA
     */
    private $google2FA;

    /**
     * @param Google2FA $google2FA
     */
    public function __construct(Google2FA $google2FA)
    {
        $this->google2FA = $google2FA;
    }

    /**
     * {@inheritdoc}
     */
    public function verifyKey(string $secret, string $key): bool
    {
        return $this->google2FA->verifyKey($secret, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function generateSecretKey(int $length, string $prefix): string
    {
        return $this->google2FA->generateSecretKey($length, $prefix);
    }

    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * {@inheritdoc}
     */
    public function getQRCodeData(string $company, string $holder, string $secretKey, int $size): string
    {
        $otpAuth = 'otpauth://totp/'
            . rawurlencode($company)
            . ':'
            . rawurlencode($holder)
            . '?' . http_build_query([
                'secret' => $secretKey,
                'issuer' => rawurlencode($company)
            ]);

        $code = new QrCode($otpAuth);
        $code->setWriterByName('png');
        $code->setSize($size);

        return 'data:image/png;base64,' . base64_encode($code->writeString());
    }
}
