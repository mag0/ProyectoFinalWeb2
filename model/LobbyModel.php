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

    public function usarMoneda($idUsuario)
    {
        $this->database->execute("UPDATE usuario SET monedas = monedas - 1 WHERE id = '$idUsuario'");
    }

    public function sumarTrampa($idUsuario)
    {
        $this->database->execute("UPDATE usuario SET trampas = trampas + 1 WHERE id = '$idUsuario'");
    }

    public function getUsuarios()
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombreUsuario NOT IN ('admin', 'editor') ORDER BY puntaje_total DESC");
    }

    public function getCategorias()
    {
        return $this->database->query("SELECT * FROM categoria");
    }

    public function crearPreguntaSugerida($pregunta)
    {
        $categoria = $pregunta['categoria'];$texto_pregunta = $pregunta['texto_pregunta'];$respuesta_correcta = $pregunta['respuesta_correcta'];
        $respuesta_1 = $pregunta['respuesta_1'];$respuesta_2 = $pregunta['respuesta_2'];$respuesta_3 = $pregunta['respuesta_3'];
        $respuesta_4 = $pregunta['respuesta_4'];$dificultad = $pregunta['dificultad'];

        $this->database->execute("INSERT INTO pregunta_sugerida (id_categoria, texto_pregunta, respuesta_correcta, respuesta_1, respuesta_2, 
                                    respuesta_3, respuesta_4, dificultad) VALUES ('$categoria', '$texto_pregunta', '$respuesta_correcta', 
                                    '$respuesta_1', '$respuesta_2', '$respuesta_3', '$respuesta_4', '$dificultad')");
    }

    public function getPuntajeMasAlto($idUsuario)
    {
        return $this->database->query("SELECT puntaje_total from usuario where id = '$idUsuario'");
    }

    public function actualizarUsuario($idUsuario, $datos_usuario)
    {
        $nombreCompleto = $datos_usuario['nombreCompleto'];$anioDeNacimiento = $datos_usuario['anioDeNacimiento'];$genero = $datos_usuario['genero'];
        $pais = $datos_usuario['pais'];$ciudad = $datos_usuario['ciudad'];$password = $datos_usuario['password'];
        //$foto = isset($datos_usuario['foto']) ? $datos_usuario['foto'] : null;

        return $this->database->execute("UPDATE usuario SET nombreCompleto = '$nombreCompleto', anioDeNacimiento = '$anioDeNacimiento', 
            genero = '$genero', pais = '$pais', ciudad = '$ciudad', password = '$password' WHERE id = '$idUsuario'");
    }

}