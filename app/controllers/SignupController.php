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
            $success = $user->save(
                [
                    "userName" => $datos['userName'],
                    "password" => $datos['password'],
                ]
            );
            if ($success) {
                return $this->response->redirect('/');
            }
            $messages = $user->getMessages();
            // $print = '';
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        } else if ($find) {
            $errorMessage = 'the user name is already used. Try another one.';
        }
        $this->view->setVar("message", $errorMessage);
    }
}
