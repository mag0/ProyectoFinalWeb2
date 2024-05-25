<?php

class UsuarioController
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

    public function registrar()
    {
        $nombreUsuario = $_POST['nombreUsuario'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepetida = $_POST['passwordRepetida'];

        $existeUsuario = $this->model->verSiExisteUsuario($nombreUsuario, $email)[0];

        if($password != $passwordRepetida){
            $error = "Las contraseñas tienen que ser iguales";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else if($existeUsuario['usuario_existe'] > 0){
            $error = "El usuario ya existe";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else{
            $this->model->agregarUsuario($nombreUsuario,$email,$password);
            header('location:index.php');
            exit();
        }
    }

    public function iniciarSesion()
    {
        $nombreUsuario = $_POST['nombreUsuario'];
        $password = $_POST['password'];

        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreYPassword($nombreUsuario, $password)[0];

        if($existeUsuario['usuario_existe'] == 1){
            $error = "El usuario no existe";
            $this->presenter->render("view/inicioDeSesionView.mustache", ["error" => $error]);
        }else{
            header('location:/ProyectoFinal/index.php/lobby/get');
            exit();
        }
    }
}
