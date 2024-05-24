<?php

class InicioDeSesionController
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
        $this->presenter->render("view/inicioDeSesionView.mustache");
    }

    public function getRegistro()
    {
        $this->presenter->render("view/registroView.mustache");
    }
}
