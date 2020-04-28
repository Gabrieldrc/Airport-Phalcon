<?php

use Phalcon\Mvc\Controller;

class NewflightController extends Controller
{
    public function newAction()
    {
        $datos = $this->request->getPost();
        $origin = $datos['origin'];
        $destiny = $datos['destiny'];
        $return = $this->flightService->newFlight($origin, $destiny);
        if ($return === true) {
            return $this->response->redirect('/flights');
        }
        $this->view->setVar("message", $return[1]);
    }

    public function formAction()
    {
    }

}