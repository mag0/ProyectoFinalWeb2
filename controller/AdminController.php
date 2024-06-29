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
        $this->presenter->render("view/graficosAdminView.mustache", ["cantJugadores" =>  $usuarios]);
    }

    public function getGrafiocsPartidas()
    {
        $usuarios = $this->model->cantidadPartidas();
        $this->presenter->render("view/graficosAdminView.mustache", ["cantPartidas" =>  $usuarios]);
    }

    public function getGraficosPreguntas()
    {
        $usuarios = $this->model->cantidadPreguntas();
        $this->presenter->render("view/graficosAdminView.mustache", ["cantPreguntas" =>  $usuarios]);
    }

    public function getGraficosPreguntascreadas()
    {
        $usuarios = $this->model->cantidadPreguntasCreadas();
        $this->presenter->render("view/graficosAdminView.mustache", ["cantPreguntasCreadas" =>  $usuarios]);
    }

    public function getGraficosPais()
    {
        $usuarios = $this->model->cantidadUsuariosPorPais();
        $this->presenter->render("view/graficosAdminView.mustache", ["cantPais" =>  $usuarios]);
    }


    public function getMenuTablas()
    {
        $this->presenter->render("view/adminView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo'], "menuTabla"=>true]);
    }

    public function getEstadisticas()
    {
        $this->presenter->render("view/tablaAdminView.mustache",
            ["cantidad_usuarios" =>  $this->model->cantidadJugadores()[0]['cantidad_usuarios'],
                "total_trampas" =>  $this->model->getTrampasTotal()[0]['total_trampas'],
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

    public function getTrampasDeUsuarios()
    {
        $usuarios = $this->model->getUsuarios();

        $this->presenter->render("view/tablaAdminView.mustache",
            ["usuariosT" =>$usuarios, "trampas" =>true]);
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

    public function getPreguntasRegistradas()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $preguntas = $this->model->getPreguntasDelDia();
            }else if ($_POST['filtro']=="semana") {
                $preguntas = $this->model->getPreguntasDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $preguntas = $this->model->getPreguntasDelMes();
            } else {
                $preguntas = $this->model->getPreguntasDelAnio();
            }
        }else{
            $preguntas = $this->model->getPreguntasDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["preguntasFiltro" =>$preguntas, "preguntas"=>true]);
    }

    public function getPaisesRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $paises = $this->model->getPaisesDelDia();
            }else if ($_POST['filtro']=="semana") {
                $paises = $this->model->getPaisesDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $paises = $this->model->getPaisesDelMes();
            } else {
                $paises = $this->model->getPaisesDelAnio();
            }
        }else{
            $paises = $this->model->getPaisesDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["paisesFiltro" =>$paises, "paises"=>true]);
    }

    public function getSexoRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $paises = $this->model->getSexoDelDia();
            }else if ($_POST['filtro']=="semana") {
                $paises = $this->model->getSexoDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $paises = $this->model->getSexoDelMes();
            } else {
                $paises = $this->model->getSexoDelAnio();
            }
        }else{
            $paises = $this->model->getSexoDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["sexoFiltro" =>$paises, "sexo"=>true]);
    }

    public function getEdadRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $paises = $this->model->getEdadDelDia();
            }else if ($_POST['filtro']=="semana") {
                $paises = $this->model->getEdadDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $paises = $this->model->getEdadDelMes();
            } else {
                $paises = $this->model->getEdadDelAnio();
            }
        }else{
            $paises = $this->model->getEdadDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["edadFiltro" =>$paises, "edad"=>true]);
    }
    public function getPorcentajesDePreguntasBienRespondidasRegistrados()
    {
        if(isset($_POST['filtro'])) {
            if ($_POST['filtro']=="dia") {
                $paises = $this->model->getPorcentajesDePreguntasBienRespondidasDelDia();
            }else if ($_POST['filtro']=="semana") {
                $paises = $this->model->getPorcentajesDePreguntasBienRespondidasDeLaSemana();
            }else if ($_POST['filtro']=="mes") {
                $paises = $this->model->getPorcentajesDePreguntasBienRespondidasDelMes();
            } else {
                $paises = $this->model->getPorcentajesDePreguntasBienRespondidasDelAnio();
            }
        }else{
            $paises = $this->model->getPorcentajesDePreguntasBienRespondidasDelDia();
        }

        $this->presenter->render("view/graficosAdminView.mustache",
            ["porcentajesDePreguntasBienRespondidasFiltro" =>$paises, "porcentajesDePreguntasBienRespondidas"=>true]);
    }

}
