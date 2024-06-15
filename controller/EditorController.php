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
        $preguntasTotales = true;
        $preguntas = $this->model->getPreguntas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas,"preguntasTotales"=>$preguntasTotales]);
    }

    public function getPreguntasReportadas()
    {
        $preguntasReportadas = true;
        $preguntas = $this->model->getPreguntasReportadas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas, "preguntasReportadas"=>$preguntasReportadas]);
    }

    public function getPreguntasSugeridas()
    {
        $preguntasSugeridas = true;
        $preguntas = $this->model->getPreguntasSugeridas();
        $this->presenter->render("view/preguntasEditorView.mustache", ["preguntas"=>$preguntas, "preguntasSugeridas"=>$preguntasSugeridas]);
    }
}