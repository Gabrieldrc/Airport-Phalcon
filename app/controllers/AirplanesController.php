<?php

use Phalcon\Mvc\Controller;

class AirplanesController extends Controller
{
    public function listAction()
    {
        $data = Airplane::find(
            [
                'limit' => 10,
            ]
        );
        if ($data != false) {
            $airplanes = [];
            foreach ($data as $plane) {
                $airplanes [] = [
                    'id' => $plane->id,
                    'passengers' => $plane->passengers,
                    'location' => $plane->location,
                    'destiny' => $plane->destiny,
                    'idFlight' => $plane->idFlight,
                ];
            }
            $this->view->setVar('airplanes',$airplanes);
        }
    }

    public function newAction()
    {
        $datos = $this->request->getPost();
        $location = $datos['location'];
        $passengers = $datos['passengers'];
        $errorMessage = '';
        $airplane = new Airplane();
        $success = $airplane->save(
            [
                "location" => $location,
                "passengers" => $passengers,
            ]
        );
        if ($success) {
            return $this->response->redirect('/airplanes/new');
        }
        $messages = $airplane->getMessages();
        foreach ($messages as $message) {
            $errorMessage .= $message->getMessage(). "\n";
        }
        $this->view->setVar("message", $errorMessage);
    }

    public function formAction()
    {
    }

}