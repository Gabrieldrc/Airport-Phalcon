<?php

final class FlightService
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
                "idAirplane" => 'NULL',
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

    public function findFlightsByOrigin(String $origin)
    {
        $data = Flight::find(
            [
                'origin = "'.$origin.'"'
                .' AND idAirplane = "NULL"',
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

    public function findById($id)
    {
        return Flight::findFirstById($id);
    }

}
