<?php

use Phalcon\Mvc\Controller;

class AirplanesController extends Controller
{
    public function listAction(int $pag = 1)
    {
        if (empty($pag) or $pag == 1) {
            $airplanes = $this->airplaneService->showTenAirplanes(1 *10);
        } else if ($pag > 0) {
            $airplanes = $this->airplaneService->showTenAirplanes($pag *10);
        } else {
            return $this->response->redirect('/airplanes');
        }
        $counted = $this->airplaneService->countAirplanes();
        
        if ( $counted > 10) {
            $cycle = ceil($counted / 10);
            settype($cycle,'int');
            $this->view->setVar('cycle',$cycle);
        }
        $this->view->setVar('airplanes',$airplanes);
    }
}