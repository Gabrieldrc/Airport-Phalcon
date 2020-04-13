<?php

use Phalcon\Mvc\Controller;

class SignUpController extends Controller
{
    public function registerAction()
    {
        $this->view->render('registering', 'signUp');
        $this->view->finish();
        echo $this->view->getContent();
    }

    public function signUpAction()
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
            $this->view->render('registering','registered');
        } else {
            $messages = $user->getMessages();
            $print = '';
            foreach ($messages as $message) {
                $print .= $message->getMessage(). "<br/>";
            }
            $this->view->setVar("message", $print);
            $this->view->render('registering','fail');
        }

        $this->view->finish();
        echo $this->view->getContent();

    }
}