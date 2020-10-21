<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\EventSubscribers;

use Vdlp\TwoFactorAuthentication\Classes\Contracts\EventSubscriber;
use Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend\PageBeforeDisplay;
use Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend\FormExtendFields;
use Vdlp\TwoFactorAuthentication\Classes\EventListeners\Backend\UserLogin;
use October\Rain\Events\Dispatcher;

/**
 * Class BackendEventSubscriber
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\EventSubscribers
 */
class BackendEventSubscriber implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function subscribe(Dispatcher $dispatcher): void
    {
        $dispatcher->listen('backend.form.extendFields', FormExtendFields::class);
        $dispatcher->listen('backend.user.login', UserLogin::class);
        $dispatcher->listen('backend.page.beforeDisplay', PageBeforeDisplay::class);
    }
}
