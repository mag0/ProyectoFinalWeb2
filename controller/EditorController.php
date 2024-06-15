<?php
class EditorController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function get()
    {
        $this->presenter->render("view/editorView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo']]);
    }

    public function getPreguntas()
    {
        $preguntas = $this->model->getPreguntas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas,"preguntasTotales"=> true]);
    }

    public function getPreguntasReportadas()
    {
        $preguntas = $this->model->getPreguntasReportadas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas, "preguntasReportadas"=> true]);
    }

    public function getPreguntasSugeridas()
    {
        $preguntas = $this->model->getPreguntasSugeridas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas, "preguntasSugeridas"=> true]);
    }

    public function eliminarPregunta()
    {
        if(isset($_GET['sugerida'])){
            $this->model->eliminarPreguntaSugerida($_GET['idPregunta']);
            $this->getPreguntasSugeridas();
        }else{
            $this->model->eliminarPregunta($_GET['idPregunta']);
            if(isset($_GET['reporte'])){
                $this->getPreguntasReportadas();
            }else{
                $this->getPreguntas();
            }
        }
    }

    public function aprobarPreguntaReportada()
    {
        $this->model->aprobarPreguntaReportada($_GET['idPregunta']);
        $this->getPreguntasReportadas();
    }

    public function crearPregunta()
    {
        if(isset($_GET['crearPregunta'])){
            $pregunta = array(
                "categoria" => htmlspecialchars($_POST['categoria']),
                "texto_pregunta" => htmlspecialchars($_POST['texto_pregunta']),
                "respuesta_correcta" => htmlspecialchars($_POST['respuesta_correcta']),
                "respuesta_1" => htmlspecialchars($_POST['respuesta_1']),
                "respuesta_2" => htmlspecialchars($_POST['respuesta_2']),
                "respuesta_3" => htmlspecialchars($_POST['respuesta_3']),
                "respuesta_4" => htmlspecialchars($_POST['respuesta_4']),
                "dificultad" => htmlspecialchars($_POST['dificultad'])
            );
            $this->model->crearPregunta($pregunta);
            $this->getPreguntas();
        }else {
            $this->presenter->render("view/formularioPregunta.mustache", ["crear" => true]);
        }
    }

    public function validarPreguntaSugerida()
    {
        if(isset($_GET['valida'])){
            $pregunta = $this->model->buscarPreguntaSugerida($_GET['idPregunta'])[0];
            $this->model->crearPregunta($pregunta);
        }
        $this->model->eliminarPreguntaSugerida($_GET['idPregunta']);
        $this->getPreguntasSugeridas();
    }

    public function modificarPregunta()
    {
        $pregunta = $this->model->buscarPregunta($_GET['idPregunta'])[0];
        $pregunta = $this->mostrarCategoria($pregunta);
        $pregunta = $this->mostrarDificultad($pregunta);
        $pregunta = $this->mostrarRespuestaCorrecta($pregunta);
        $this->presenter->render("view/formularioPregunta.mustache", ["modificar"=>true, "pregunta"=>$pregunta]);
    }

    private function mostrarCategoria($pregunta)
    {
        $pregunta['isGeografia'] = $pregunta['categoria'] === 'Geografia';
        $pregunta['isCultura'] = $pregunta['categoria'] === 'Cultura';
        $pregunta['isMatematica'] = $pregunta['categoria'] === 'Matematica';
        $pregunta['isArte'] = $pregunta['categoria'] === 'Arte';
        $pregunta['isCiencia'] = $pregunta['categoria'] === 'Ciencia';
        $pregunta['isHistoria'] = $pregunta['categoria'] === 'Historia';
        $pregunta['isDeportes'] = $pregunta['categoria'] === 'Deportes';
        return $pregunta;
    }

    private function mostrarDificultad($pregunta)
    {
        $pregunta['isFacil'] = $pregunta['dificultad'] === 'facil';
        $pregunta['isNormal'] = $pregunta['dificultad'] === 'normal';
        $pregunta['isDificil'] = $pregunta['dificultad'] === 'dificil';
        return $pregunta;
    }

    private function mostrarRespuestaCorrecta($pregunta)
    {
        $pregunta['is1'] = $pregunta['respuesta_correcta'] === '1';
        $pregunta['is2'] = $pregunta['respuesta_correcta'] === '2';
        $pregunta['is3'] = $pregunta['respuesta_correcta'] === '3';
        $pregunta['is4'] = $pregunta['respuesta_correcta'] === '4';
        return $pregunta;
    }
}