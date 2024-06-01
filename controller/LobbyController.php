<?php
session_start();
class LobbyController
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

        $this->presenter->render("view/lobbyView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario']]);
    }
}