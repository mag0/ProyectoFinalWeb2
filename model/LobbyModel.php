<?php

class LobbyModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuario($nombreUsuario)
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario'");
    }
}