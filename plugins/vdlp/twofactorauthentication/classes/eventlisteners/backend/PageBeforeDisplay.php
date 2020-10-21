<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend;

use Backend\Classes\Controller;
use Backend\Controllers\Auth;
use Backend\Helpers\Backend;
use Backend\Models\User;
use Illuminate\Http\Request;
use Throwable;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorManager;

/**
 * Class PageBeforeDisplay
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend
 */
class PageBeforeDisplay
{
    /**
     * @var Backend
     */
    private $backendHelper;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Backend $backendHelper
     * @param Request $request
     */
    public function __construct(Backend $backendHelper, Request $request)
    {
        $this->backendHelper = $backendHelper;
        $this->request = $request;
    }

    /**
     * @param Controller $controller
     * @return mixed
     */
    public function handle(Controller $controller)
    {
        if (!($controller instanceof Auth) || $this->request->getMethod() !== 'POST') {
            return null;
        }

        /** @var TwoFactorManager $twoFactorManager */
        $twoFactorManager = new TwoFactorManager($this->request->ip());

        try {
            $twoFactorManager->interceptLogin(
                $this->request->get('login'),
                $this->request->get('password'),
                $this->request->get('remember', false)
            );

            $userId = $twoFactorManager->getInterceptionUserId();

            $user = User::query()->findOrFail($userId);

            $secret = (string) $user->getAttribute('vdlp-twofactorauthentication_google2fa_secret');

            if ($secret === '') {
                return null;
            }

            return $this->backendHelper->redirect('vdlp/twofactorauthentication/twofactor/verify');
        } catch (Throwable $e) {
            return null;
        }
    }
}
