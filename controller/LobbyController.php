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
        $_SESSION['numeroPregunta'] = 1;
        $this->presenter->render("view/lobbyView.mustache", ["nombreUsuario" =>$_SESSION['nombreUsuario'],"puntaje" =>$_SESSION['puntaje']]);
    }

    public function verRanking()
    {
        $this->presenter->render("view/rankingView.mustache");
    }

    public function verPerfil()
    {

        $usuario = $this->model->getUsuario($_SESSION['nombreUsuario'])[0];
        $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
        $usuario['esFemenino'] = $usuario['genero'] === 'femenino';
        $this->presenter->render("view/perfilView.mustache", ["usuario" =>$usuario]);
    }
}