<?php
namespace Auth\Adapter;

use Doctrine\ORM\EntityManager;
use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Authentication\Result;
use User\Entity\User;

class AuthAdapter implements AdapterInterface
{
    private EntityManager $em;
    private string $email;
    private string $password;

    public function __construct(EntityManager $em, string $email, string $password)
    {
        $this->em = $em;
        $this->email = $email;
        $this->password = $password;
    }

    public function authenticate(): Result
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $this->email]);

        if (!$user) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, null, ['User not found']);
        }

        if (!password_verify($this->password, $user->getPassword())) {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['Invalid password']);
        }

        return new Result(Result::SUCCESS, $user->getId(), ['Authenticated successfully']);
    }
}
