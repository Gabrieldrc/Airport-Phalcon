<?php

use Phalcon\Mvc\Controller;

class AirplanesController extends Controller
{
    public function listAction()
    {
        $airplanes = $this->airplaneService->showTenAirplanes(0);
        $this->view->setVar('airplanes',$airplanes);
    }
}