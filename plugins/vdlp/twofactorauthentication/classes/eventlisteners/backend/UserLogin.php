<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend;

use Backend\Classes\AuthManager;
use Backend\Helpers\Backend;
use Backend\Models\User;

/**
 * Class UserLogin
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend
 */
class UserLogin
{
    /**
     * @var Backend
     */
    private $backendHelper;

    /**
     * @param Backend $backendHelper
     */
    public function __construct(Backend $backendHelper)
    {
        $this->backendHelper = $backendHelper;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        /** @var User $user */
        $user = AuthManager::instance()->getUser();
        if (empty($user->getAttribute('vdlp-twofactorauthentication_google2fa_secret'))) {
            return;
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $this->backendHelper->redirect('vdlp/twofactorauthentication/twofactor/verify')->send();
    }
}
