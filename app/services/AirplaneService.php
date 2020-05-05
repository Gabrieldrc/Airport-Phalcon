<?php

class AirplaneService
{
    public function newAirplane(String $location, int $passengers)
    {
        /**
         * This fuction save a new Airplane on
         * the db and return an array with:
         * key=0 => true, or
         * key=0 => false && key=1 => 'errorMessages'
         */
        if ($passengers <= 0) {
            return $return = 
            [
                false,
                'number of passengers most be more than 0'
            ];
        }
        $airplane = new Airplane();
        $success = $airplane->save(
            [
                "location" => $location,
                "passengers" => $passengers,
            ]
        );
        $errorMessage = '';
        $return = [];
        if ($success) {
            return $return[] = true;
        }
        $messages = $airplane->getMessages();
        foreach ($messages as $message) {
            $errorMessage .= $message->getMessage(). "\n";
        }
        $return [] = false;
        $return [] = $errorMessage;

        return $return;
    }

    public function showTenAirplanes(int $to)
    {
        $data = Airplane::find(
            [
                'conditions' => 'id between "'.($to - 9).'" AND "'.$to.'"',
                // 'limit' => 10,
            ]
        );
        if( $data == false) {
            return [];
        }
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
        return $airplanes;
    }

    public function countAirplanes()
    {
        return Airplane::count();
    }

    public function findById($id)
    {
        $data = Airplane::findById($id);
        if( $data == false) {
            return [];
        }
        $airplane = [];
        foreach ($data as $plane) {
            $airplane = [
                'id' => $plane->id,
                'passengers' => $plane->passengers,
                'location' => $plane->location,
                'destiny' => $plane->destiny,
                'idFlight' => $plane->idFlight,
            ];
        }
        return $airplane; 
    }

    public function assignFlight($idFlight, $idAirplane, $destiny)
    {
        $airplane = Airplane::findFirstById($idAirplane);
        $return = [];
        $errorMessage = '';
        if( $airplane == false) {
            $messages = $airplane->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        } else {
            $airplane->idFlight = $idFlight;
            $airplane->destiny = $destiny;
            $success = $airplane->save();
            if ($success) {
                return $return [] = true;
            }
            $messages = $airplane->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        }
        $return =
        [
            false,
            $errorMessage,
        ];
        return $return;
    }
}
