<?php
class AdminController
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
        $this->presenter->render("view/adminView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo'], "menu"=>true]);
    }

    public function getGraficos()
    {
        $this->presenter->render("view/adminView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo'], "menuGrafico"=>true]);
    }

    public function getGraficoUsuarios()
    {
        $usuarios = $this->model->cantidadJugadores();
        $this->presenter->render("view/graficosAdminView.mustache", ["jugadores" =>  $usuarios]);
    }

    public function getMenuTablas()
    {
        $this->presenter->render("view/adminView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo'], "menuTabla"=>true]);
    }

    public function getEstadisticas()
    {
        $this->presenter->render("view/tablaAdminView.mustache",
            ["cantidad_usuarios" =>  $this->model->cantidadJugadores()[0]['cantidad_usuarios'],
                "cantidad_partidas" =>  $this->model->cantidadPartidas()[0]['cantidad_partidas'],
                "cantidad_preguntas" =>  $this->model->cantidadPreguntas()[0]['cantidad_preguntas'],
                "porcentaje_respondidas_correctamente" =>  $this->model->porcentajePreguntasBienRespondidas()[0]['porcentaje_respondidas_correctamente'],
                "estadisticas"=>true]);
    }

    public function getPorcentaje()
    {
        $usuarios = $this->model->getPorcentajesDePreguntasBienRespondidas();
        $this->presenter->render("view/tablaAdminView.mustache",
            ["tablaPorcentajes" =>true,"porcentajes" =>$usuarios]);
    }

    public function getUsuariosPorPais()
    {
        $usuarios = $this->model->getUsuariosPorPais();
        $this->presenter->render("view/tablaAdminView.mustache",
            ["paises" =>true,"usuariosPais" =>$usuarios]);
    }

    public function getUsuariosPorGenero()
    {
        $usuarios = $this->model->getUsuariosPorSexo();
        $this->presenter->render("view/tablaAdminView.mustache",
            ["genero" =>true,"usuariosSexo" =>$usuarios]);
    }

    public function getUsuariosPorEdad()
    {
        $usuarios = $this->model->getUsuariosPorEdad();
        $this->presenter->render("view/tablaAdminView.mustache",
            ["edad" =>true,"usuariosEdad" =>$usuarios]);
    }

    public function getUsuariosRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $usuarios = $this->model->getUsuariosRegistradosDia();
            }else if ($_POST['filtro']=="semana") {
                $usuarios = $this->model->getUsuariosRegistradosSemana();
            }else if ($_POST['filtro']=="mes") {
                $usuarios = $this->model->getUsuariosRegistradosMes();
            } else {
                $usuarios = $this->model->getUsuariosRegistradosAnio();
            }
        }else{
            $usuarios = $this->model->getUsuariosRegistradosDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["usuariosFiltro" =>$usuarios, "usuarios"=>true]);
    }

    public function getPartidasRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $partidas = $this->model->getPartidasDelDia();
            }else if ($_POST['filtro']=="semana") {
                $partidas = $this->model->getPartidasDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $partidas = $this->model->getPartidasDelMes();
            } else {
                $partidas = $this->model->getPartidasDelAnio();
            }
        }else{
            $partidas = $this->model->getPartidasDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["partidasFiltro" =>$partidas, "partidas"=>true]);
    }

   /* public function getCantidadPartidasJugadas()
    {
        $cantidadDePartidasJugadas = $this->model->getCantidadPartidasJugadas();
        $this->presenter->render("view/graficosAdminView.mustache", ["jugadores" =>  $cantidadDePartidasJugadas , "partidas" => true]);
    }
*/
}
