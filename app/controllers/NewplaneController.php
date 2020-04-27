<?php

use Phalcon\Mvc\Controller;

class NewplaneController extends Controller
{
    public function newAction()
    {
        $datos = $this->request->getPost();
        $location = $datos['location'];
        $passengers = $datos['passengers'];
        settype($passengers,'int');
        $return = $this->airplaneService->newPlane($location, $passengers);
        if ($return === true) {
            return $this->response->redirect('/airplanes');
        }
        $this->view->setVar("message", $return[1]);
    }

    public function formAction()
    {
    }

}