<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            [
                'name' => $user->userName,
            ]
        );
    }
    
    public function homeAction()
    {
    }

    public function logInAction()
    {
        $datos = $this->request->getPost();
        $userName = $datos['userName'];
        $errorMessage = '';
        $user = User::findFirstByuserName($userName);

        if ($user) {
            if ($this->security->checkHash($datos['password'], $user->password)) {
                $this->_registerSession($user);
                // $this->flash->success(
                //     'Welcome ' . $user->userName
                // );
                return $this->response->redirect('principal');
            }
            $errorMessage = 'wrong password';
        } else if (!$user) {
            $this->security->hash(rand());
            $errorMessage = 'user name doesn\'t exist';
        }
        $this->view->setVar('message', $errorMessage);
    }

    public function logOutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('/');
    }
}
