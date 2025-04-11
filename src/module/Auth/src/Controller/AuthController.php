<?php

namespace Auth\Controller;

use Auth\Form\LoginForm;
use Auth\Form\RegisterForm;
use Auth\Service\AuthService;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\ViewModel;

class AuthController extends AbstractRestfulController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerAction()
    {
        $form = new RegisterForm();

        if($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());

            if($form->isValid()) {
                $data = $form->getData();
                $ok = $this->authService->register($data['email'], $data['password']);
                if($ok) {
                    return $this->redirect()->toRoute('login');
                }
                $form->get('email')->setMessages(array('Email already exists'));
            }
        }
        return new ViewModel(['form' => $form]);
    }

    public function loginAction()
    {
        $form = new LoginForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            if ($this->authService->login($data['email'], $data['password'])) {
                return $this->redirect()->toRoute('home');
            }

            $form->get('email')->setMessages(array('Invalid credentials'));
        }

        return new ViewModel(['form' => $form]);
    }

    public function logoutAction()
    {
        $this->authService->logout();
        return $this->redirect()->toRoute('login');
    }
}