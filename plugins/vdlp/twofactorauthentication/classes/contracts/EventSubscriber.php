<?php

declare(strict_types=1);

namespace Vdlp\TwoFactorAuthentication\Classes\Contracts;

use October\Rain\Events\Dispatcher;

/**
 * Interface EventSubscriber
 *
 * @package Vdlp\TwoFactorAuthentication\Classes\Contracts
 */
interface EventSubscriber
{
    /**
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher): void;
}
