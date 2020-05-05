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
        } else {
            $this->view->setVar('state', $airplane['idFlight']);
        }
        if (!empty($flights)) {
            $this->view->setVar('flights', $flights);
        }
        if ($this->session->has('error')) {
            // Retrieve its value
            $error = $this->session->get('error');
            $this->view->setVar('message',$error);
            $this->session->remove('error');
        }
    }

    public function assignAction()
    {
        $datos = $this->request->getPost();
        $idAirplane = $datos['idAirplane'];
        $idFlight = $datos['idFlight'];
        $errorMessage = '';
        $return1 = $this->flightService->assignAirplane($idFlight, $idAirplane);
        // var_dump($return1);
        if ($return1[0] === true) {
            $return2 = $this->airplaneService->assignFlight($idFlight, $idAirplane, $return1[1]);
            // var_dump($return2);die;
            if ($return2 === true) {
                return $this->response->redirect('/airplanes');
            }
            $errorMessage .= $return2[1];
        } else {
            $errorMessage .= $return1[1];
        }
        $this->session->set('error', $errorMessage);
        return $this->response->redirect('/airplanes/assign_a_flight/'.$idAirplane);
    }
}