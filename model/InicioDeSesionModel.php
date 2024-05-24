<?php

class InicioDeSesionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
}