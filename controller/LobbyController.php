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

       
        if (!isset($_SESSION['usuarioActivo']['id'])) {
            $_SESSION['usuarioActivo']['id'] = 0;
        }

        $partidas = $this->model->getPartidas($_SESSION['usuarioActivo']['id']);

        foreach ($partidas as $indice => $partida) {
            $partidas[$indice]['numeroDePartida'] = $indice + 1;
        }

        $puntajeMaximo = $this->model->getPuntajeMasAlto($_SESSION['usuarioActivo']['id'])[0]['puntaje_total'];

        $this->presenter->render("view/lobbyView.mustache", [
            "usuarioActivo" => $_SESSION['usuarioActivo'],
            "puntaje" => $puntajeMaximo,
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
        if (isset($_GET['usuarioBuscado'])) {
            $usuario = $this->model->getUsuario($_GET['usuarioBuscado'])[0];
            $partidas = $this->model->getPartidas($usuario['id']);

            foreach ($partidas as $indice => $partida) {
                $partidas[$indice]['numeroDePartida'] = $indice + 1;
            }
            $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
            $usuario['esFemenino'] = $usuario['genero'] === 'femenino';
            $this->presenter->render("view/perfilView.mustache", ["usuario" => $usuario, "esUsuarioSesion" => false,
                "partidas" => $partidas]);
        } else {
            $usuario = $_SESSION['usuarioActivo'];
            $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
            $usuario['esFemenino'] = $usuario['genero'] === 'femenino';
            $this->presenter->render("view/perfilView.mustache", ["usuario" => $usuario, "esUsuarioSesion" => true]);
        }
    }

    public function sugerirPregunta()
    {
        if(isset($_GET['sugerir'])){
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
            $this->model->crearPreguntaSugerida($pregunta);
            $this->presenter->render("view/resultadoPartidaView.mustache", ["sugerir" => "Pregunta enviada correctamente!"]);
        }else {
            $categorias = $this->model->getCategorias();
            $this->presenter->render("view/formularioPregunta.mustache", ["sugerir" => true, "categorias" => $categorias]);
        }
    }
}