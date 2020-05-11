<?php

final class AirplaneService
{
    public function newAirplane(String $location, int $passengers): array
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
                "idFlight"  => 'NULL',
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
        return Airplane::findFirstById($id);
    }

    public function assignFlight(Airplane $airplane, Flight $flight)
    {
        $errorMessage = '';
        if ($airplane->idFlight !== 'NULL' or $flight->idAirplane !== 'NULL') {
            return [
                false,
                'Have already assigned',
            ];
        }
        $airplane->idFlight = $flight->id;
        $airplane->destiny = $flight->destiny;
        $flight->idAirplane = $airplane->id;
        $successFlight = $flight->save();
        $successAirplane = $airplane->save();
        if ($successFlight && $successAirplane) {
            return true;
        }
        if (!$successFlight) {
            $messages = $flight->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        }
        if (!$successAirplane) {
            $messages = $airplane->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        }
        return [
            false,
            $errorMessage,
        ];
    }
}
