<?php

namespace Auth\Service;

use Laminas\Authentication\AuthenticationService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AuthServiceFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $authService = $container->get(AuthenticationService::class);
        return new AuthService($em, $authService);
    }
}