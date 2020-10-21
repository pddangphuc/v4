<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes;

use Backend\Classes\AuthManager;
use Backend\Models\User;
use Illuminate\Contracts\Session\Session;
use October\Rain\Auth\AuthException;
use Vdlp\TwoFactorAuthentication\Plugin;

/**
 * Class TwoFactorManager
 * @package Vdlp\TwoFactorAuthentication\Classes
 */
class TwoFactorManager
{
    /**
     * Interception TTL in seconds
     *
     * @var int
     */
    public const INTERCEPTION_TTL = 120;

    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @var Session $session
     */
    private $session;

    /**
     * @var string The IP address of this request
     */
    private $ipAddress;

    /**
     * @var bool Flag to enable login throttling
     */
    protected $useThrottle = true;

    /**
     * TwoFactorManager constructor.
     *
     * @param string $ipAddress
     */
    public function __construct(string $ipAddress)
    {
        $this->authManager = AuthManager::instance();
        $this->session = resolve(Session::class);
        $this->ipAddress = $ipAddress;
    }

    /**
     * Intercept the login request.
     * @param string $login
     * @param string $password
     * @param bool $remember
     * @return void
     * @throws AuthException
     */
    public function interceptLogin(string $login, string $password, bool $remember): void
    {
        $backendForceRemember = (bool) config('cms.backendForceRemember', true);

        $remember = $backendForceRemember ? true : $remember;

        $user = $this->validateCredentials([
            'login' => $login,
            'password' => $password,
        ]);

        $this->session->put(Plugin::SESSION_KEY, [
            'user' => $user->getKey(),
            'remember' => $remember,
            'timestamp' => time() + self::INTERCEPTION_TTL,
        ]);
    }

    /**
     * @return bool
     */
    public function isInterceptionValid(): bool
    {
        if (!$this->session->has(Plugin::SESSION_KEY)) {
            return false;
        }

        /** @var array $interceptionData */
        $interceptionData = $this->session->get(Plugin::SESSION_KEY);

        if ($interceptionData['timestamp'] > time()) {
            return true;
        }

        $this->session->forget(Plugin::SESSION_KEY);

        return false;
    }

    /**
     * Invalidate Interception.
     *
     * @return void
     */
    public function invalidateInterception(): void
    {
        $this->session->forget(Plugin::SESSION_KEY);
    }

    /**
     * @return int|null
     */
    public function getInterceptionUserId(): ?int
    {
        if (!$this->session->has(Plugin::SESSION_KEY)) {
            return null;
        }

        /** @var array $interceptionData */
        $interceptionData = $this->session->get(Plugin::SESSION_KEY);

        return $interceptionData['user'] ?? null;
    }

    /**
     * @return bool
     */
    public function rememberUser(): bool
    {
        if (!$this->session->has(Plugin::SESSION_KEY)) {
            return false;
        }

        /** @var array $interceptionData */
        $interceptionData = $this->session->get(Plugin::SESSION_KEY);

        return $interceptionData['remember'] ?? false;
    }

    /**
     * Validate login credentials
     *
     * @param array $credentials
     * @return User
     * @throws AuthException
     */
    public function validateCredentials(array $credentials): User
    {
        /*
         * Default to the login name field or fallback to a hard-coded 'login' value
         */
        $loginName = $this->authManager->createUserModel()->getLoginName();
        $loginCredentialKey = isset($credentials[$loginName]) ? $loginName : 'login';

        if (empty($credentials['password']) || empty($credentials[$loginCredentialKey])) {
            throw new AuthException('Invalid credentials provided.');
        }

        /*
         * If the fallback 'login' was provided and did not match the necessary
         * login name, swap it over
         */
        if ($loginCredentialKey !== $loginName) {
            $credentials[$loginName] = $credentials[$loginCredentialKey];
            unset($credentials[$loginCredentialKey]);
        }

        $throttle = $this->authManager->findThrottleByLogin($credentials[$loginName], $this->ipAddress);
        $throttle->check();

        /*
         * Look up the user by authentication credentials.
         */
        try {
            /** @var User $user */
            $user = $this->authManager->findUserByCredentials($credentials);
        } catch (AuthException $ex) {
            $throttle->addLoginAttempt();
            throw $ex;
        }

        $throttle->clearLoginAttempts();
        $user->clearResetPassword();

        return $user;
    }
}
