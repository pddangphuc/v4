<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication;

/**
 * Interface TwoFactorAuthentication
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication
 */
interface TwoFactorAuthentication
{
    /**
     * @param string $secret
     * @param string $key
     * @return bool
     */
    public function verifyKey(string $secret, string $key): bool;

    /**
     * @param int $length
     * @param string $prefix
     * @return string
     */
    public function generateSecretKey(int $length, string $prefix): string;

    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * @param string $company
     * @param string $holder
     * @param string $secretKey
     * @param int $size
     * @return string Base64 encode image data which can be used in <img src="">
     */
    public function getQRCodeData(string $company, string $holder, string $secretKey, int $size): string;
}
