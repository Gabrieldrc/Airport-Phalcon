<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function registerAction()
    {
    }

    public function newSignUpAction()
    {
        $datos = $this->request->getPost();
        $userName = $datos['userName'];
        $errorMessage = '';
        $find = User::findFirst(
            [
                "userName = '$userName'",
            ]
        );
        if (!$find) {
            $user = new User();
            $user->userName = $datos['userName'];
            $user->password = $this->security->hash($datos['password']);
            $success = $user->save();
            if ($success) {
                return $this->response->redirect('/');
            }
            $messages = $user->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        } else if ($find) {
            $errorMessage = 'the user name is already used. Try another one.';
        }
        $this->view->setVar("message", $errorMessage);
    }
}
