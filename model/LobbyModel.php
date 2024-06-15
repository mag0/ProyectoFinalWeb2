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

    public function crearPreguntaSugerida($pregunta)
    {
        $categoria = $pregunta['categoria'];
        $texto_pregunta = $pregunta['texto_pregunta'];
        $respuesta_correcta = $pregunta['respuesta_correcta'];
        $respuesta_1 = $pregunta['respuesta_1'];
        $respuesta_2 = $pregunta['respuesta_2'];
        $respuesta_3 = $pregunta['respuesta_3'];
        $respuesta_4 = $pregunta['respuesta_4'];
        $dificultad = $pregunta['dificultad'];

        $this->database->execute("INSERT INTO preguntas_sugeridas (categoria, texto_pregunta, respuesta_correcta, respuesta_1, respuesta_2, respuesta_3, respuesta_4, dificultad) 
                              VALUES ('$categoria', '$texto_pregunta', '$respuesta_correcta', '$respuesta_1', '$respuesta_2', '$respuesta_3', '$respuesta_4', '$dificultad')");
    }

}