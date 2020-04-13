<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    public function homeAction() {}

    public function logInAction()
    {
        $userName = $this->request->getPost('userName');
        $password = $this->request->getPost('password');
    }
}
