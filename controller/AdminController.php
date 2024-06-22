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
        $this->presenter->render("view/adminView.mustache", ["usuarioActivo"=>$_SESSION['usuarioActivo']]);
    }

    public function getGraficos()
    {
        $this->presenter->render("view/graficosAdminView.mustache", ["jugadores" =>  $this->model->cantidadJugadores()]);
    }

   /* public function getCantidadPartidasJugadas()
    {
        $cantidadDePartidasJugadas = $this->model->getCantidadPartidasJugadas();
        $this->presenter->render("view/graficosAdminView.mustache", ["jugadores" =>  $cantidadDePartidasJugadas , "partidas" => true]);
    }
*/
}
