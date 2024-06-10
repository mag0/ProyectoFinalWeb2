<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getPregunta($dificultadActual, $idUsuario)
    {
        $resultado = $this->database->query("SELECT p.* FROM pregunta p LEFT JOIN preguntas_vistas up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
           WHERE up.id_pregunta IS NULL AND p.dificultad = '$dificultadActual' ORDER BY RAND() LIMIT 1");

        if (empty($resultado)) {
            // Eliminar todas las preguntas vistas por el usuario
            $this->database->execute("DELETE FROM preguntas_vistas WHERE id_usuario = '$idUsuario'");

            // Intentar obtener una pregunta nuevamente
            $resultado = $this->database->query("SELECT p.* FROM pregunta p LEFT JOIN preguntas_vistas up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
            WHERE up.id_pregunta IS NULL AND p.dificultad = '$dificultadActual' ORDER BY RAND() LIMIT 1");

            // Si todavía no hay preguntas, devolver un mensaje o valor indicativo
            if (empty($resultado)) {
                return null; // O puedes devolver un mensaje, un array vacío, etc.
            }
        }

        return $resultado;
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

    public function marcarPregunta($idPregunta, $idUsuario)
    {
        $this->database->execute("INSERT INTO `preguntas_vistas` (`id_usuario`, `id_pregunta`) VALUES ('$idUsuario', '$idPregunta')");
    }

}