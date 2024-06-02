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
        if(isset($_POST['respuesta'])){
            echo $_POST['respuesta'];
            echo $_POST['respuestaCorrecta'];
        }
            $this->pregunta = $this->model->getPregunta()[0];
            $_SESSION['respuestaCorrecta'] = $this->pregunta['respuesta_correcta'];

            $this->presenter->render("view/partidaView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],
                "pregunta" =>$this->pregunta]);
    }
    public function verificarRespuesta()
    {

        if(!isset($_POST['respuesta']) || $_POST['respuesta'] == $_POST['respuestaCorrecta']){
            $_SESSION['puntaje'] += 1;
            header('location:/ProyectoFinal/index.php?controller=partida&action=get&respuesta='.$_POST['respuesta']);
            exit();
        }else{
            header('location:/ProyectoFinal/index.php?controller=lobby&action=get');
            exit();
        }
    }


}