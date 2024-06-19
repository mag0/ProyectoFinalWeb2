<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function cantidadJugadores()
    {
        return $this->database->query("SELECT DATE(fechaRegistro) AS fecha, COUNT(*) AS cantidad_usuarios
            FROM usuario
            GROUP BY DATE(fechaRegistro)
            ORDER BY fecha");
    }
}
