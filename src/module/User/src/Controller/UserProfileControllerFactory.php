<?php

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use User\Service\UserService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class UserProfileControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $userService = $container->get(UserService::class);
        $authenticationService = $container->get(AuthenticationService::class);
        return new UserProfileController($em, $userService, $authenticationService);
    }
}