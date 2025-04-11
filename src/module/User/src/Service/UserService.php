<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use User\Entity\User;

class UserService
{
    private EntityManager $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function updateUser(User $user, array $data): void
    {
        $user->setFirstName($data['firstName'] ?? null);
        $user->setLastName($data['lastName'] ?? null);
        $user->setEmail($data['email'] ?? null);
        $user->setMobilePhone($data['mobilePhone'] ?? null);
        $user->setCountry($data['country'] ?? null);
        $user->setCity($data['city'] ?? null);
        $user->setAddress($data['address'] ?? null);

        $this->em->flush();
    }

    public function deleteUser(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}