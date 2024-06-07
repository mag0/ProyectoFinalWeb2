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

    public function getPartidas($idUsuario)
    {
        return $this->database->query("SELECT * FROM partida WHERE id_usuario = '$idUsuario'");
    }

    public function getCantidadDePartidas($idUsuario)
    {
        return $this->database->query("SELECT COUNT(*) FROM partida WHERE id_usuario = '$idUsuario'");
    }

    public function getUsuarios()
    {
        return $this->database->query("SELECT * FROM usuario ORDER BY puntaje_total DESC");
    }

}