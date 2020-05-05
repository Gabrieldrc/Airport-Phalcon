<?php

class FlightService
{
    public function newFlight(String $origin, String $destiny)
    {
        /**
         * This fuction save a new Flight on
         * the db and return an array with:
         * key=0 => true, or
         * key=0 => false && key=1 => 'errorMessages'
         */
        $flight = new Flight();
        $success = $flight->save(
            [
                "origin" => $origin,
                "destiny" => $destiny,
                "passengers" => 0,
            ]
        );
        $errorMessage = '';
        $return = [];
        if ($success) {
            return $return[] = true;
        }
        $messages = $flight->getMessages();
        foreach ($messages as $message) {
            $errorMessage .= $message->getMessage(). "\n";
        }
        $return [] = false;
        $return [] = $errorMessage;

        return $return;
    }

    public function showTenFlights(int $to)
    {
        $data = Flight::find(
            [
                'conditions' => 'id between "'.($to - 9).'" AND "'.$to.'"',
            ]
        );
        if( $data == false) {
            return [];
        }
        $flights = [];
        foreach ($data as $flight) {
            $flights [] = [
                'id' => $flight->id,
                'passengers' => $flight->passengers,
                'origin' => $flight->origin,
                'destiny' => $flight->destiny,
                'idAirplane' => $flight->idAirplane,
            ];
        }
        return $flights;
    }

    public function countFlights()
    {
        return Flight::count();
    }

    public function findFlights(array $airplane)
    {
        $data = Flight::find(
            [
                "origin = '".$airplane['location']."'",
                'idAirplane = "NULL"',
            ]
        );
        if( $data == false) {
            return [];
        }
        $flights = [];
        foreach ($data as $flight) {
            $flights [] = [
                'id' => $flight->id,
                'passengers' => $flight->passengers,
                'origin' => $flight->origin,
                'destiny' => $flight->destiny,
                'idAirplane' => $flight->idAirplane,
            ];
        }
        return $flights;
    }

    public function assignAirplane($idFlight, $idAirplane)
    {
        $flight = Flight::findFirstById($idFlight);
        $return = [];
        $errorMessage = '';
        if( $flight == false) {
            $messages = $flight->getMessages();
            foreach ($messages as $message) {
                $errorMessage .= $message->getMessage(). "\n";
            }
        } else {
            $flight->idAirplane = $idAirplane;
            $success = $flight->save();
            if ($success) {
                return $return =
                [
                    true,
                    $flight->destiny,
                ];
            }
            $messages = $flight->getMessages();
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
