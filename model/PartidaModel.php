<?php

class PartidaModel
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

    public function getPregunta($dificultadActual, $idUsuario)
    {
        $resultado = $this->database->query("SELECT p.*, c.nombre AS categoria_nombre, c.color AS categoria_color FROM pregunta p 
                                         LEFT JOIN pregunta_vista up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
                                         LEFT JOIN categoria c ON p.id_categoria = c.id WHERE up.id_pregunta IS NULL AND p.dificultad = '$dificultadActual' 
                                         ORDER BY RAND() LIMIT 1");

        if (empty($resultado)) {
            // Eliminar todas las pregunta vistas por el usuario
            $this->database->execute("DELETE FROM pregunta_vista WHERE id_usuario = '$idUsuario'");

            // Intentar obtener una pregunta nuevamente
            $resultado = $this->database->query("SELECT p.*, c.nombre AS categoria_nombre, c.color AS categoria_color FROM pregunta p 
                                             LEFT JOIN pregunta_vista up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
                                             LEFT JOIN categoria c ON p.id_categoria = c.id WHERE up.id_pregunta IS NULL AND p.dificultad = '$dificultadActual' 
                                             ORDER BY RAND() LIMIT 1");

            // Si todavía no hay pregunta, cambiar a la siguiente dificultad
            if (empty($resultado)) {
                $resultado = $this->database->query("SELECT p.*, c.nombre AS categoria_nombre, c.color AS categoria_color FROM pregunta p 
                                             LEFT JOIN pregunta_vista up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
                                             LEFT JOIN categoria c ON p.id_categoria = c.id WHERE up.id_pregunta IS NULL AND p.dificultad = 'normal' 
                                             ORDER BY RAND() LIMIT 1");
            }

            // Si todavía no hay pregunta, cambiar a la siguiente dificultad
            if (empty($resultado)) {
                $resultado = $this->database->query("SELECT p.*, c.nombre AS categoria_nombre, c.color AS categoria_color FROM pregunta p 
                                             LEFT JOIN pregunta_vista up ON p.id = up.id_pregunta AND up.id_usuario = '$idUsuario' 
                                             LEFT JOIN categoria c ON p.id_categoria = c.id WHERE up.id_pregunta IS NULL AND p.dificultad = 'dificil' 
                                             ORDER BY RAND() LIMIT 1");
            }

            // Si todavía no hay pregunta, devolver un mensaje o valor indicativo
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

        $this->database->execute("INSERT INTO partida (id_usuario, puntaje_obtenido, fecha) VALUES ('$id_usuario', '$puntaje_obtenido', '$fecha')");
    }

    public function getPuntajeMasAlto($idUsuario)
    {
        return $this->database->execute("SELECT puntaje_total from usuario where id = '$idUsuario'");
    }

    public function reemplazarPuntajeMaximo($puntaje, $idUsuario)
    {
        $this->database->execute("UPDATE usuario SET puntaje_total = '$puntaje' WHERE id = '$idUsuario'");
    }

    public function usarTrampa($idUsuario)
    {
        $this->database->execute("UPDATE usuario SET trampas = trampas - 1 WHERE id = '$idUsuario'");
    }

    public function marcarPregunta($idPregunta, $idUsuario)
    {
        $this->database->execute("INSERT INTO `pregunta_vista` (`id_usuario`, `id_pregunta`) VALUES ('$idUsuario', '$idPregunta')");
    }

    public function reportarPregunta($idPregunta)
    {
        return $this->database->execute("UPDATE pregunta SET reportada = true WHERE id = '$idPregunta'");
    }

    public function sumarPregunta($idPregunta)
    {
        $this->database->execute("UPDATE pregunta SET respondidas = respondidas + 1 WHERE id = '$idPregunta'");
    }

    public function sumarPreguntaAlUsuario($idUsuario)
    {
        $this->database->execute("UPDATE usuario SET preguntas_respondidas = preguntas_respondidas + 1 WHERE id = $idUsuario");
    }

    public function sumarPreguntaBienRespondidaAlUsuario($idUsuario)
    {
        $this->database->execute("UPDATE usuario SET preguntas_bien_respondidas = preguntas_bien_respondidas + 1 WHERE id = $idUsuario");
    }

    public function sumarPreguntaBienRespondida($idPregunta)
    {
        $this->database->execute("UPDATE pregunta SET respondidas_correctamente = respondidas_correctamente + 1 WHERE id = '$idPregunta'");
    }

    public function cambiarDificultad($idPregunta, $dificultad)
    {
        $this->database->execute("UPDATE pregunta SET dificultad = '$dificultad'  WHERE id = '$idPregunta'");
    }

}