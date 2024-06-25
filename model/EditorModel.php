<?php

class EditorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getPreguntas()
    {
        return $this->database->query("SELECT p.*, c.nombre AS nombre_categoria, c.color AS color_categoria, c.id AS id_categoria FROM pregunta p 
                                        LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.reportada = false");
    }

    public function getPreguntasReportadas()
    {
        return $this->database->query("SELECT p.*, c.nombre AS nombre_categoria FROM pregunta p LEFT JOIN categoria c ON p.id_categoria = c.id 
                                         WHERE p.reportada = true");
    }

    public function getPreguntasSugeridas()
    {
        return $this->database->query("SELECT p.*, c.nombre AS nombre_categoria FROM pregunta_sugerida p LEFT JOIN categoria c ON p.id_categoria = c.id");
    }

    public function eliminarPregunta($idPregunta)
    {
        return $this->database->execute("DELETE FROM pregunta WHERE id = '$idPregunta'");
    }

    public function buscarPreguntaSugerida($idPregunta)
    {
        return $this->database->query("SELECT * FROM pregunta_sugerida WHERE id = '$idPregunta'");
    }

    public function eliminarPreguntaSugerida($idPregunta)
    {
        return $this->database->execute("DELETE FROM pregunta_sugerida WHERE id = '$idPregunta'");
    }

    public function buscarPregunta($idPregunta)
    {
        return $this->database->query("SELECT p.*, c.nombre AS nombre_categoria, c.color AS color_categoria FROM pregunta p 
                                        LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.id = '$idPregunta'");
    }

    public function crearPregunta($pregunta)
    {
        $categoria = $pregunta['id_categoria'];$texto_pregunta = $pregunta['texto_pregunta'];$respuesta_correcta = $pregunta['respuesta_correcta'];
        $respuesta_1 = $pregunta['respuesta_1'];$respuesta_2 = $pregunta['respuesta_2'];$respuesta_3 = $pregunta['respuesta_3'];$respuesta_4 = $pregunta['respuesta_4'];
        $dificultad = $pregunta['dificultad'];

        $this->database->execute("INSERT INTO pregunta (id_categoria, texto_pregunta, respuesta_correcta, respuesta_1, respuesta_2, respuesta_3, respuesta_4, dificultad) 
            VALUES ('$categoria', '$texto_pregunta', '$respuesta_correcta', '$respuesta_1', '$respuesta_2', '$respuesta_3', '$respuesta_4', '$dificultad')");
    }

    public function aprobarPreguntaReportada($idPregunta)
    {
        return $this->database->execute("UPDATE pregunta SET reportada = false WHERE id = '$idPregunta'");
    }

    public function actualizarPregunta($pregunta)
    {
        $idPregunta = $pregunta['idPregunta'];$categoria = $pregunta['categoria'];$texto_pregunta = $pregunta['texto_pregunta'];
        $respuesta_correcta = $pregunta['respuesta_correcta'];$respuesta_1 = $pregunta['respuesta_1'];$respuesta_2 = $pregunta['respuesta_2'];
        $respuesta_3 = $pregunta['respuesta_3'];$respuesta_4 = $pregunta['respuesta_4'];$dificultad = $pregunta['dificultad'];

        return $this->database->execute("UPDATE pregunta SET id_categoria = '$categoria', texto_pregunta = '$texto_pregunta', 
                                        respuesta_correcta = '$respuesta_correcta', respuesta_1 = '$respuesta_1', respuesta_2 = '$respuesta_2', 
                                        respuesta_3 = '$respuesta_3', respuesta_4 = '$respuesta_4', dificultad = '$dificultad' WHERE id = '$idPregunta'");
    }

    public function getCategorias()
    {
        return $this->database->query("SELECT * FROM categoria");
    }
}

