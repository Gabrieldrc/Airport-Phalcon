<?php

use Phalcon\Mvc\Controller;

class AirplaneassignController extends Controller
{
    public function formAction($id)
    {
        $airplane = $this->airplaneService->findById($id);
        if (!$airplane) {
            return $this->response->redirect('/airplanes');
        }
        if ($airplane->idFlight !== 'NULL') {
            $this->view->setVar('disabled', 'disabled');
            $this->view->setVar('state', $airplane->idFlight);
        } else {
            $this->view->setVar('state', 'available');
        }
        $this->view->setVar('id',$id);
        $this->view->setVar('location',$airplane->location);
        $this->view->setVar('passengers',$airplane->passengers);    
        $flights = $this->flightService->findFlightsByOrigin($airplane->location);
        $this->view->setVar('flights', $flights);
        if ($this->session->has('error')) {
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
        $airplane = $this->airplaneService->findById($idAirplane);
        if ($airplane === false) {
            $this->session->set('error', 'wrong to find Airplane');
            return $this->response->redirect('/airplanes/assign_a_flight/'.$idAirplane);
        }
        $flight = $this->flightService->findById($idFlight);
        if ($flight == false) {
            $this->session->set('error', 'wrong to find Flight');
            return $this->response->redirect('/airplanes/assign_a_flight/'.$idAirplane);
        }
        if ($airplane->location !== $flight->origin) {
            $this->session->set('error', 'do not start from the same location');
            return $this->response->redirect('/airplanes/assign_a_flight/'.$idAirplane);
        }
        $return = $this->airplaneService->assignFlight($airplane,$flight);
        if ($return === true) {
            return $this->response->redirect('/airplanes');
        }
        $errorMessage .= $return[1];
        $this->session->set('error', $errorMessage);
        return $this->response->redirect('/airplanes/assign_a_flight/'.$idAirplane);
    }
}