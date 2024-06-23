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
        return $this->database->query("SELECT COUNT(*) AS cantidad_usuarios FROM usuario");
    }

    public function cantidadPartidas()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_partidas FROM partida");
    }

    public function cantidadPreguntas()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_preguntas FROM pregunta");
    }

    public function porcentajePreguntasBienRespondidas()
    {
        return $this->database->query("SELECT FLOOR(COUNT(CASE WHEN respondidas_correctamente > 0 THEN 1 END) * 100.0 / COUNT(*)) AS porcentaje_respondidas_correctamente FROM pregunta");
    }

    public function getPorcentajesDePreguntasBienRespondidas()
    {
        return $this->database->query("SELECT nombreUsuario, CASE WHEN preguntas_respondidas = 0 THEN 0 ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100)
                                            END AS porcentaje_preguntas_correctas FROM usuario");
    }

    public function getUsuariosPorPais()
    {
        return $this->database->query("SELECT pais, COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY pais");
    }

    public function getUsuariosPorSexo()
    {
        return $this->database->query("SELECT genero, COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY genero");
    }

    public function getUsuariosPorEdad()
    {
        return $this->database->query("SELECT CASE WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'menores'
                                        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'medio' ELSE 'jubilados' END AS grupo_edad,
                                        COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY grupo_edad;");
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
