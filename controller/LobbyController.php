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

        $usuario = $this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario']);

        $partidas = $this->model->getPartidas($usuario[0]['id']);

        foreach ($partidas as $indice => $partida) {
            $partidas[$indice]['numeroDePartida'] = $indice + 1;
        }

        $this->presenter->render("view/lobbyView.mustache", [
            "usuarioActivo" => $usuario,
            "partidas" => $partidas
        ]);
    }

    public function comprarTrampa()
    {
        $_SESSION['numeroPregunta'] = 1;
        $_SESSION['puntajeActual'] = 0;

        $usuario = $this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario']);

        $partidas = $this->model->getPartidas($usuario[0]['id']);

        foreach ($partidas as $indice => $partida) {
            $partidas[$indice]['numeroDePartida'] = $indice + 1;
        }

        if($this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario'])[0]['monedas'] == 0){
            $this->presenter->render("view/lobbyView.mustache", [
                "usuarioActivo" => $usuario,
                "partidas" => $partidas,
                "sinMonedas" => "No tenes monedas capo"
            ]);
        }else{
            $this->model->usarMoneda($_SESSION['usuarioActivo']['id']);
            $this->model->sumarTrampa($_SESSION['usuarioActivo']['id']);
            $usuario = $this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario']);
            $this->presenter->render("view/lobbyView.mustache", [
                "usuarioActivo" => $usuario,
                "partidas" => $partidas
            ]);
        }
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
            $usuario = $this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario'])[0];
            $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
            $usuario['esFemenino'] = $usuario['genero'] === 'femenino';
            $this->presenter->render("view/perfilView.mustache", ["usuario" => $usuario, "esUsuarioSesion" => true]);
        }
    }

    public function actualizarUsuario()
    {
        $datos_usuario = array(
            "nombreCompleto" => htmlspecialchars($_POST['nombreCompleto']),
            "anioDeNacimiento" => htmlspecialchars($_POST['anioDeNacimiento']),
            "genero" => htmlspecialchars($_POST['genero']),
            "pais" => htmlspecialchars($_POST['pais']),
            "ciudad" => htmlspecialchars($_POST['ciudad']),
            "password" => $_POST['password']
        );
        $this->model->actualizarUsuario($_SESSION['usuarioActivo']['id'], $datos_usuario);
        $usuario = $this->model->getUsuario($_SESSION['usuarioActivo']['nombreUsuario'])[0];
        $usuario['esMasculino'] = $usuario['genero'] === 'masculino';
        $usuario['esFemenino'] = $usuario['genero'] === 'femenino';

        $this->presenter->render("view/perfilView.mustache", ["usuario" => $usuario, "esUsuarioSesion" => true, "mensaje" => "usuario modificado"]);
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