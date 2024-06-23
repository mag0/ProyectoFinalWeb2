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
        $dificultadActual = $this->asignarDificultad();
        $this->pregunta = $this->model->getPregunta($dificultadActual, $_SESSION['usuarioActivo']['id'])[0];
        $_SESSION['respuestaCorrecta'] = $this->pregunta['respuesta_correcta'];
        $_SESSION['pregunta'] = $this->pregunta;
        $colorDificultad = $this->asignarColorADificultad($_SESSION['pregunta']);
        $this->model->marcarPregunta($_SESSION['pregunta']['id'],$_SESSION['usuarioActivo']['id']);

        $this->model->cambiarDificultad($_SESSION['pregunta']['id'], $this->asignarDificultadPorCantidadDeVecesRespondidas());

        $this->presenter->render("view/partidaView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],
            "pregunta" =>$this->pregunta, "numeroPregunta" =>$_SESSION['numeroPregunta'], "colorDificultad" => $colorDificultad]);
    }
    public function verificarRespuesta()
    {
        $this->model->sumarPregunta($_SESSION['pregunta']['id']);
        if(isset($_GET['tiempo']) || $_POST['respuesta'] != $_SESSION['respuestaCorrecta']){
                if(isset($_GET['tiempo'])){
                    $mensaje = 'Tiempo agotado';
                }else{
                    $mensaje = 'Respuesta Incorrecta';
                }
                $this->model->sumarPreguntaAlUsuario($_SESSION['usuarioActivo']['id']);
                $respuestaCorrecta = $this->getRespuestaCorrectaEnTexto($_SESSION['pregunta'],$_SESSION['respuestaCorrecta']);
                $partida = array(
                    "id_usuario" => htmlspecialchars($_SESSION['usuarioActivo']['id']),
                    "puntaje_obtenido" => htmlspecialchars($_SESSION['puntajeActual']),
                    "fecha" => date("Y-m-d")
                );
                $_SESSION['usuarioActivo']['puntaje_total'] += $_SESSION['puntajeActual'];
                if( $this->model->getPuntajeMasAlto($_SESSION['usuarioActivo']['id'])<$_SESSION['puntajeActual']){
                    $this->model->reemplazarPuntajeMaximo($_SESSION['puntajeActual'], $_SESSION['usuarioActivo']['id']);
                }
                $this->model->guardarPartida($partida);
                $this->presenter->render("view/resultadoPartidaView.mustache", ["puntaje" =>$_SESSION['puntajeActual'],
                    "numeroPregunta" =>$_SESSION['numeroPregunta']-1, "respuestaCorrecta" =>$respuestaCorrecta, "mensaje" =>$mensaje]);
        }else{
            $_SESSION['puntaje'] += 1;
            $_SESSION['puntajeActual'] += 1;
            $_SESSION['numeroPregunta'] += 1;
            $this->model->sumarPreguntaAlUsuario($_SESSION['usuarioActivo']['id']);
            $this->model->sumarPreguntaBienRespondidaAlUsuario($_SESSION['usuarioActivo']['id']);
            $this->model->sumarPreguntaBienRespondida($_SESSION['pregunta']['id']);
            header('location:/ProyectoFinal/index.php?controller=partida&action=get');
            exit();
        }
    }

    public function reportarPregunta()
    {
        $this->model->reportarPregunta($_GET['idPregunta']);
        $mensaje = "Revisaremos la pregunta cuanto antes, disculpe las molestias";
        $this->presenter->render("view/resultadoPartidaView.mustache", ["reporte" =>$mensaje]);
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

    public function asignarColorADificultad($dificultad)
    {
        $colores = [
            "facil" => "lightgreen",
            "normal" => "orange",
            "dificil" => "red"
        ];

        return $colores[$dificultad['dificultad']] ?? "grey";
    }
    private function asignarDificultad()
    {
        if($_SESSION['numeroPregunta'] <= 10){
            $dificultadActual = 'facil';
        }else if($_SESSION['numeroPregunta'] >= 11 && $_SESSION['numeroPregunta'] <= 20){
            $dificultadActual = 'normal';
        }else{
            $dificultadActual = 'dificil';
        }
        return $dificultadActual;
    }

    private function asignarDificultadPorCantidadDeVecesRespondidas()
    {
        if($_SESSION['pregunta']['respondidas']==0){
            $porcentaje = 0;
        }else{
            $porcentaje = ($_SESSION['pregunta']['respondidas_correctamente']*100)/$_SESSION['pregunta']['respondidas'];
        }

        if($porcentaje>70){
            $dificultad = 'facil';
        }else if($porcentaje<30){
            $dificultad = 'dificil';
        }else{
            $dificultad = 'normal';
        }
        return $dificultad;
    }

}