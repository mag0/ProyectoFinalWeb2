<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getPregunta()
    {
        return $this->database->query("SELECT * FROM pregunta ORDER BY RAND() LIMIT 1");
    }
}