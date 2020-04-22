<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
    }

    public function logInAction()
    {
        $datos = $this->request->getPost();
        $userName = $datos['userName'];
        $errorMessage = '';
        $user = User::findFirst(
            [
                "userName = '$userName'",
            ]
        );
        if ($user) {
            if ($user->userName == $datos['userName'] && $user->password == $datos['password']) {
                return $this->response->redirect('principal');
            }
            $errorMessage = 'wrong password';
        } else if (!$user) {
            $errorMessage = 'user name doesn\'t exist';
        }
        $this->view->setVar('message', $errorMessage);
    }
}
