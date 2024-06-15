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
        return $this->database->query("SELECT * FROM pregunta");
    }

    public function getPreguntasReportadas()
    {
        return $this->database->query("SELECT * FROM pregunta WHERE reportada = true");
    }

    public function getPreguntasSugeridas()
    {
        return $this->database->query("SELECT * FROM preguntas_sugeridas");
    }
}
