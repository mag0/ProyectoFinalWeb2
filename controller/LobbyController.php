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
        $_SESSION['puntajeActual'] = 0;

       
        if (!isset($_SESSION['id'])) {

            $_SESSION['id'] = 0;
        }

        $partidas = $this->model->getPartidas($_SESSION['id']);

        foreach ($partidas as $indice => $partida) {
            $partidas[$indice]['numeroDePartida'] = $indice + 1;
        }


        if (!isset($_SESSION['puntaje'])) {
            $_SESSION['puntaje'] = 0;
        }

        $this->presenter->render("view/lobbyView.mustache", [
            "usuarioActivo" => $_SESSION['usuarioActivo'],
            "puntaje" => $_SESSION['puntaje'],
            "partidas" => $partidas
        ]);
    }

    public function verRanking()
    {
        $usuarios = $this->model->getUsuarios();
        foreach ($usuarios as $indice => $usuario) {
            $usuarios[$indice]['numeroDeUsuario'] = $indice + 1;
        }
        $this->presenter->render("view/rankingView.mustache", ["usuarios" => $usuarios]);
    }

    public function verPerfil()
    {
        $esUsuarioSesion = false;
        if (isset($_GET['usuarioBuscado'])) {
            $usuario = $this->model->getUsuario($_GET['usuarioBuscado'])[0];
        } else {
            $usuario = $this->model->getUsuario($_SESSION['nombreUsuario'])[0];
            $esUsuarioSesion = true;
        }
        $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
        $usuario['esFemenino'] = $usuario['genero'] === 'femenino';
        $this->presenter->render("view/perfilView.mustache", ["usuario" => $usuario, "esUsuarioSesion" => $esUsuarioSesion]);
    }
}
?>