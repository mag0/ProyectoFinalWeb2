<?php
class PartidaController
{
    private $model;
    private $presenter;
    private $pregunta;
    private $puntaje;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function get()
    {

        $this->pregunta = $this->model->getPregunta()[0];
        $_SESSION['respuestaCorrecta'] = $this->pregunta['respuesta_correcta'];
        $this->presenter->render("view/partidaView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],
            "pregunta" =>$this->pregunta, "numeroPregunta" =>$_SESSION['numeroPregunta']]);
    }
    public function verificarRespuesta()
    {
        if(!isset($_POST['respuesta']) || $_POST['respuesta'] == $_POST['respuestaCorrecta']){
            $_SESSION['puntaje'] += 1;
            $_SESSION['numeroPregunta'] += 1;
            header('location:/ProyectoFinal/index.php?controller=partida&action=get');
            exit();
        }else{
            $this->presenter->render("view/resultadoPartidaView.mustache", ["puntaje" =>$_SESSION['puntaje'], "numeroPregunta" =>$_SESSION['numeroPregunta']]);
        }
    }
}