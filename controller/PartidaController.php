<?php
class PartidaController
{
    private $model;
    private $presenter;

    private $pregunta;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function get()
    {
        if(!isset($_GET['respuesta']) || $_GET['respuesta'] == $this->pregunta[0]['respuesta_correcta']){
            $this->pregunta = $this->model->getPregunta()[0];
            $this->presenter->render("view/partidaView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],
                "pregunta" =>$this->pregunta]);
        }else{

            //header('location:/ProyectoFinal/index.php?controller=lobby&action=get');
            //exit();
        }
    }

}