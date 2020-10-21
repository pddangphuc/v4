<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Controllers;

use Backend\Classes\AuthManager;
use Backend\Classes\Controller;
use Backend\Helpers\Backend as BackendHelper;
use Backend\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use October\Rain\Auth\AuthException;
use October\Rain\Flash\FlashBag;
use Throwable;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication\SecretKey;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorAuthentication\TwoFactorAuthentication;
use Vdlp\TwoFactorAuthentication\Classes\TwoFactorManager;

/**
 * Class TwoFactor
 *
 * @package Vdlp\TwoFactorAuthentication
 */
class TwoFactor extends Controller
{
    /**
     * {@inheritdoc}
     */
    protected $publicActions = ['verify', 'onVerify'];

    /**
     * @var BackendHelper
     */
    private $backendHelper;

    /**
     * @var FlashBag
     */
    private $flashBag;

    /**
     * @var Redirector
     */
    private $redirector;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var SecretKey
     */
    private $secretKey;

    /**
     * @var TwoFactorAuthentication
     */
    private $twoFactorAuthentication;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        BackendHelper $backendHelper,
        FlashBag $flashBag,
        Redirector $redirector,
        Request $request,
        SecretKey $secretKey,
        TwoFactorAuthentication $twoFactorAuthentication
    ) {
        parent::__construct();

        $this->layout = 'auth';
        $this->bodyClass = 'preload';

        $this->backendHelper = $backendHelper;
        $this->flashBag = $flashBag;
        $this->redirector = $redirector;
        $this->request = $request;
        $this->secretKey = $secretKey;
        $this->twoFactorAuthentication = $twoFactorAuthentication;
    }

    /**
     * vdlp/twofactorauthentication/twofactor/verify
     *
     * @return RedirectResponse|null
     */
    public function verify(): ?RedirectResponse
    {
        $this->bodyClass = 'signin';

        $twoFactorManager = new TwoFactorManager($this->request->ip());

        if (!$twoFactorManager->isInterceptionValid()
            || AuthManager::instance()->check()
        ) {
            return $this->redirector->to($this->backendHelper->url(''));
        }

        $userId = $twoFactorManager->getInterceptionUserId();

        if ($userId === null) {
            return $this->redirector->to($this->backendHelper->url(''));
        }

        if (post('postback')) {
            return $this->verify_onVerify($userId, $twoFactorManager);
        }

        $this->bodyClass .= ' preload';

        return null;
    }

    private function verify_onVerify(int $userId, TwoFactorManager $twoFactorManager): ?RedirectResponse
    {
        if (!$this->request->has('key')) {
            return null;
        }

        try {
            $user = User::query()->findOrFail($userId);
        } catch (Throwable $e) {
            return $this->redirector->to($this->backendHelper->url(''));
        }

        $userSecret = $this->secretKey->decrypt(
            (string) $user->getAttribute('vdlp-twofactorauthentication_google2fa_secret')
        );

        if ($this->twoFactorAuthentication->verifyKey($userSecret, $this->request->get('key'))) {
            try {
                AuthManager::instance()->login($user, $twoFactorManager->rememberUser());
                $twoFactorManager->invalidateInterception();
            } catch (AuthException $exception) {
                $this->flashBag->error($exception->getMessage());
                return null;
            }

            return $this->redirector->to($this->backendHelper->url(''));
        }

        $this->flashBag->error(
            trans('vdlp.twofactorauthentication::lang.2fa.invalid_authentication_code')
        );

        return null;
    }
}
