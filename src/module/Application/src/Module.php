<?php

declare(strict_types=1);

namespace Application;

use Laminas\Mvc\MvcEvent;
use Laminas\Session\SessionManager;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $session = new SessionManager();
        $session->start();
    }
}
