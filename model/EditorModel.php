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
        return $this->database->query("SELECT * FROM pregunta WHERE reportada = false");
    }

    public function getPreguntasReportadas()
    {
        return $this->database->query("SELECT * FROM pregunta WHERE reportada = true");
    }

    public function getPreguntasSugeridas()
    {
        return $this->database->query("SELECT * FROM preguntas_sugeridas");
    }

    public function eliminarPregunta($idPregunta)
    {
        return $this->database->execute("DELETE FROM pregunta WHERE id= '$idPregunta'");
    }

    public function buscarPreguntaSugerida($idPregunta)
    {
        return $this->database->query("SELECT * FROM preguntas_sugeridas WHERE id= '$idPregunta'");
    }

    public function eliminarPreguntaSugerida($idPregunta)
    {
        return $this->database->execute("DELETE FROM preguntas_sugeridas WHERE id= '$idPregunta'");
    }

    public function buscarPregunta($idPregunta)
    {
        return $this->database->query("SELECT * FROM pregunta WHERE id= '$idPregunta'");
    }

    public function crearPregunta($pregunta)
    {
        $categoria = $pregunta['categoria'];
        $texto_pregunta = $pregunta['texto_pregunta'];
        $respuesta_correcta = $pregunta['respuesta_correcta'];
        $respuesta_1 = $pregunta['respuesta_1'];
        $respuesta_2 = $pregunta['respuesta_2'];
        $respuesta_3 = $pregunta['respuesta_3'];
        $respuesta_4 = $pregunta['respuesta_4'];
        $dificultad = $pregunta['dificultad'];

        $this->database->execute("INSERT INTO pregunta (categoria, texto_pregunta, respuesta_correcta, respuesta_1, respuesta_2, respuesta_3, respuesta_4, dificultad) 
                              VALUES ('$categoria', '$texto_pregunta', '$respuesta_correcta', '$respuesta_1', '$respuesta_2', '$respuesta_3', '$respuesta_4', '$dificultad')");
    }

    public function aprobarPreguntaReportada($idPregunta)
    {
        return $this->database->execute("UPDATE pregunta SET reportada = false WHERE id = '$idPregunta'");
    }

    public function actualizarPregunta($pregunta)
    {
        $idPregunta = $pregunta['idPregunta'];
        $categoria = $pregunta['categoria'];
        $texto_pregunta = $pregunta['texto_pregunta'];
        $respuesta_correcta = $pregunta['respuesta_correcta'];
        $respuesta_1 = $pregunta['respuesta_1'];
        $respuesta_2 = $pregunta['respuesta_2'];
        $respuesta_3 = $pregunta['respuesta_3'];
        $respuesta_4 = $pregunta['respuesta_4'];
        $dificultad = $pregunta['dificultad'];

        return $this->database->execute("UPDATE pregunta SET categoria = '$categoria', texto_pregunta = '$texto_pregunta', respuesta_correcta = '$respuesta_correcta',
                                            respuesta_1 = '$respuesta_1', respuesta_2 = '$respuesta_2', respuesta_3 = '$respuesta_3', respuesta_4 = '$respuesta_4', dificultad = '$dificultad'
                                                WHERE id = '$idPregunta';");
    }

}
