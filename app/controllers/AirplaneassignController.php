<?php

use Phalcon\Mvc\Controller;

class AirplaneassignController extends Controller
{
    public function formAction($id)
    {
        $airplane = $this->airplaneService->findById($id);
        if ($airplane == false) {
            $this->response->redirect('/airplanes');
        }
        $flights = $this->flightService->findFlights($airplane);
        $this->view->setVar('id',$id);
        $this->view->setVar('location',$airplane['location']);
        $this->view->setVar('passengers',$airplane['passengers']);
        if (empty($airplane['idFlight'])) {
            $this->view->setVar('state', 'available');
        }
        if (!empty($flights)) {
            $this->view->setVar('flights', $flights);
        }
    }

    public function assignAction()
    {
    }
}