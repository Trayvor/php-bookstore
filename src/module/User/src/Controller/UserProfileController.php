<?php

namespace User\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Entity\User;
use User\Form\UserProfileForm;
use User\Service\UserService;

class UserProfileController extends AbstractActionController
{
    private EntityManager $em;
    private UserService $userService;
    private AuthenticationService $authenticationService;

    public function __construct(EntityManager $em, UserService $userService, AuthenticationService $authenticationService)
    {
        $this->em = $em;
        $this->userService = $userService;
        $this->authenticationService = $authenticationService;
    }

    private function getCurrentUser()
    {
        $userId = $this->authenticationService->getIdentity();
        return $userId ? $this->em->getRepository(User::class)->find($userId) : null;
    }

    public function indexAction()
    {
        $user = $this->getCurrentUser();
        if (!$user) return $this->redirect()->toRoute('login');
        return new ViewModel(['user' => $user,]);
    }

    public function editAction()
    {
        $user = $this->getCurrentUser();
        if (!$user) return $this->redirect()->toRoute('login');

        $form = new UserProfileForm($user);
        $form->bind($user);
        $form->prepare();

        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $this->em->flush();
                return $this->redirect()->toRoute('profile');
            }
        }
        return new ViewModel(['form' => $form]);
    }
}
