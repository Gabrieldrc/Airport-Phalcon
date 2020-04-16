<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    public function homeAction() {}

    public function logInAction()
    {
        $userName = $this->request->getPost('userName');
        $password = $this->request->getPost('password');

        $phql = 'SELECT * FROM Users WHERE userName = "'.$userName.'"';

        $user = $this->modelsManager->executeQuery($phql);

        $data = [];

        foreach ($user as $key) {
            $data [] = $key->userName;
            $data [] =  $key->password;
        }

        if ($data[0] === $userName && $data[1] === $password) {
            return $this->response->redirect('menu');
        }
        $this->view->setVar('message', 'error en el username o password');
        $this->view->render('registering','fail');
        $this->view->finish();
        echo $this->view->getContent();

    }
}
