<?php

use Phalcon\Mvc\Controller;

class FlightsController extends Controller
{
    public function listAction(int $pag = 1)
    {
        if (empty($pag) or $pag == 1) {
            $flights = $this->flightService->showTenFlights(1 *10);
        } else if ($pag > 0) {
            $flights = $this->flightService->showTenFlights($pag *10);
        } else {
            return $this->response->redirect('/flights');
        }
        $counted = $this->flightService->countFlights();
        
        if ( $counted > 10) {
            $cycle = ceil($counted / 10);
            settype($cycle,'int');
            $this->view->setVar('cycle',$cycle);
        }
        $this->view->setVar('flights',$flights);
    }
}