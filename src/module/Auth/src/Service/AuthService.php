<?php
namespace Auth\Service;

use Auth\Adapter\AuthAdapter;
use Doctrine\ORM\EntityManager;
use Laminas\Authentication\AuthenticationService;
use User\Entity\User;

class AuthService
{
    private EntityManager $em;
    private AuthenticationService $authenticationService;

    public function __construct(EntityManager $em, AuthenticationService $authenticationService)
    {
        $this->em = $em;
        $this->authenticationService = $authenticationService;
    }

    public function register(string $email, string $password): bool
    {
        if ($this->em->getRepository(User::class)->findOneBy(['email' => $email])) {
            return false;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

    public function login(string $email, string $password): bool
    {
        $adapter = new AuthAdapter($this->em, $email, $password);
        $result = $this->authenticationService->authenticate($adapter);
        return $result->isValid();
    }

    public function logout(): void
    {
        $this->authenticationService->clearIdentity();
    }

    public function isLoggedIn(): bool
    {
        return $this->authenticationService->hasIdentity();
    }

    public function getIdentity(): ?User
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        $userId = $this->authenticationService->getIdentity();
        return $this->em->find(User::class, $userId);
    }
}
