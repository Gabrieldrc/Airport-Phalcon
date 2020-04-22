<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function registerAction()
    {
    }

    public function newSignUpAction()
    {
        $user = new Users();

        // Store and check for errors
        $success = $user->save(
            $this->request->getPost(),
            [
                "userName",
                "password",
            ]
        );

        if ($success) {
            return $this->response->redirect('/');
        }
        $messages = $user->getMessages();
        $print = '';
        foreach ($messages as $message) {
            $print .= $message->getMessage(). "\n";
        }
        $this->view->setVar("message", $print);
    }
}