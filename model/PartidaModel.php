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

    public function guardarPartida($partida)
    {
        $id_usuario = $partida['id_usuario'];
        $puntaje_obtenido = $partida['puntaje_obtenido'];
        $fecha= $partida['fecha'];

        $this->database->execute("INSERT INTO partida (id_usuario, puntaje_obtenido, fecha) 
                                VALUES ('$id_usuario', '$puntaje_obtenido', '$fecha')");
    }

    public function sumarPuntaje($puntaje, $nombreUsuario)
    {
        $this->database->execute("UPDATE usuario SET puntaje_total = puntaje_total + '$puntaje' WHERE nombreUsuario = '$nombreUsuario'");
    }
}