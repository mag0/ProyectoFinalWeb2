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
        $this->pregunta = $this->model->getPregunta()[0];
        $_SESSION['respuestaCorrecta'] = $this->pregunta['respuesta_correcta'];
        $_SESSION['pregunta'] = $this->pregunta;
        $color = $this->asignarColorACategoria($_SESSION['pregunta']);
        $this->presenter->render("view/partidaView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],
            "pregunta" =>$this->pregunta, "numeroPregunta" =>$_SESSION['numeroPregunta'], "color" => $color]);
    }
    public function verificarRespuesta()
    {
        if(!isset($_POST['respuesta']) || $_POST['respuesta'] == $_POST['respuestaCorrecta']){
            $_SESSION['puntaje'] += 1;
            $_SESSION['puntajeActual'] += 1;
            $_SESSION['numeroPregunta'] += 1;
            header('location:/ProyectoFinal/index.php?controller=partida&action=get');
            exit();
        }else{
            $respuestaCorrecta = $this->getRespuestaCorrectaEnTexto($_SESSION['pregunta'],$_POST['respuestaCorrecta']);
            $this->presenter->render("view/resultadoPartidaView.mustache", ["puntaje" =>$_SESSION['puntajeActual'], "numeroPregunta" =>$_SESSION['numeroPregunta']-1, "respuestaCorrecta" =>$respuestaCorrecta]);
        }
    }

    public function getRespuestaCorrectaEnTexto($respuesta, $numeroRespuesta)
    {
        switch ($numeroRespuesta){
            case 1:
                $respuestaCorrecta = $respuesta['respuesta_1'];
                break;
            case 2:
                $respuestaCorrecta = $respuesta['respuesta_2'];
                break;
            case 3:
                $respuestaCorrecta = $respuesta['respuesta_3'];
                break;
            case 4:
                $respuestaCorrecta = $respuesta['respuesta_4'];
                break;
        }
        return $respuestaCorrecta;
    }

    public function asignarColorACategoria($categoria)
    {
        $colores = [
            "Geografía" => "blue",
            "Historia" => "red",
            "Deportes" => "green",
            "Cultura" => "orange",
            "Ciencia" => "purple",
            "Literatura" => "goldenrod",
            "Matemáticas" => "cyan",
            "Música" => "magenta",
            "Arte" => "crimson",
            "Cine" => "salmon"
        ];

        return $colores[$categoria['categoria']] ?? "grey";
    }
}