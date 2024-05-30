<?php

class UsuarioController

{
    private $model;
    private $presenter;
    private $mailer;

    public function __construct($model, $presenter, $mailer)
    {
        $this->model = $model;
        $this->presenter = $presenter;
        $this->mailer = $mailer;
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
            "anioDeNacimiento" => $_POST['anioDeNacimiento'],
            "genero" => $_POST['genero'],
            "pais" => $_POST['pais'],
            "ciudad" => $_POST['ciudad'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "passwordRepetida" => $_POST['passwordRepetida'],
            "nombreUsuario" => $_POST['nombreUsuario'],
            "perfil" => $_POST['perfil'],
            "fechaRegistro" => date("Y-m-d")
        );
        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreEEmail(
            $datos_usuario["nombreUsuario"],$datos_usuario["email"])[0];

        if($datos_usuario["password"] != $datos_usuario["passwordRepetida"]){
            $error = "Las contraseñas tienen que ser iguales";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else if($existeUsuario['usuario_existe'] > 0){
            $error = "Ya existe un usuario con ese nombre y/o email";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        }else{
            $this->model->agregarUsuario($datos_usuario);

            // Enviar correo de confirmación
            $to = $datos_usuario['email'];
            $subject = 'Confirmación de Registro';
            $body = 'Gracias por registrarte en nuestro sitio. Por favor, confirma tu correo electrónico haciendo clic en el siguiente enlace: <a href="http://example.com/confirm?token=someToken">Confirmar</a>';
            $result = $this->mailer->sendEmail($to, $subject, $body);

            // Manejar resultado del envío del correo
            if ($result !== 'El mensaje ha sido enviado') {
                $error = "Hubo un problema al enviar el correo de confirmación. Por favor, inténtelo de nuevo.";
                $this->presenter->render("view/registroView.mustache", ["error" => $error]);
            } else {
                header('location:index.php');
                exit();
            }
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
