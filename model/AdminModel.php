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
    /*public function cantidadDePartidasJugadas()
    {
        return $this->database->query("SELECT DATE(fecha) AS fecha, COUNT(*) AS cantidad_Partidas_Jugadas
            FROM partida
            GROUP BY DATE(fecha)
            ORDER BY fecha");
    }

}*/
