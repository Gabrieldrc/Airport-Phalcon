<?php

use Phalcon\Mvc\Model;

class Flight extends Model
{
    public $id;
    public $passengers;
    public $origin;
    public $destiny;
    public $idAirplane;
}