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
        $datos_usuario = array(
            "nombreCompleto" => $_POST['nombreCompleto'],
            "anioDeNacimiento" => $_POST['nombreUsuario'],
            "genero" => $_POST['genero'],
            "pais" => $_POST['pais'],
            "ciudad" => $_POST['ciudad'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "passwordRepetida" => $_POST['passwordRepetida'],
            "nombreUsuario" => $_POST['nombreUsuario'],
            "perfil" => $_POST['perfil'],
            "fechaRegistro" => "null"
        );

        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreEEmail(
            $datos_usuario["nombreUsuario"],$datos_usuario["email"])[0];

        if($datos_usuario["password"] != $datos_usuario["passwordRepetida"]){
            $error = "Las contraseñas tienen que ser iguales";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else if($existeUsuario['usuario_existe'] > 0){
            $error = "El usuario ya existe";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else{
            $this->model->agregarUsuario($datos_usuario);
            header('location:index.php');
            exit();
        }
    }

    public function iniciarSesion()
    {
        $nombreUsuario = $_POST['nombreUsuario'];
        $password = $_POST['password'];

        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreYPassword($nombreUsuario, $password)[0];

        if($existeUsuario['usuario_existe'] == 0){
            $error = "Datos invalidos";
            $this->presenter->render("view/inicioDeSesionView.mustache", ["error" => $error]);
        }else{
            header('location:/ProyectoFinal/index.php?controller=lobby&action=get');
            exit();
        }
    }
}
