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
            "nombreCompleto" => htmlspecialchars($_POST['nombreCompleto']),
            "anioDeNacimiento" => htmlspecialchars($_POST['anioDeNacimiento']),
            "genero" => htmlspecialchars($_POST['genero']),
            "pais" => htmlspecialchars($_POST['pais']),
            "ciudad" => htmlspecialchars($_POST['ciudad']),
            "email" => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
            "password" => $_POST['password'],
            "passwordRepetida" => $_POST['passwordRepetida'],
            "nombreUsuario" => htmlspecialchars($_POST['nombreUsuario']),
            "perfil" => htmlspecialchars($_POST['perfil']),
            "fechaRegistro" => date("Y-m-d")
        );

        if (!$datos_usuario["email"]) {
            $error = "Email no válido";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
            return;
        }

        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreEEmail(
            $datos_usuario["nombreUsuario"], $datos_usuario["email"]
        )[0];

        if ($datos_usuario["password"] !== $datos_usuario["passwordRepetida"]) {
            $error = "Las contraseñas tienen que ser iguales";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        } elseif ($existeUsuario['usuario_existe'] > 0) {
            $error = "Ya existe un usuario con ese nombre y/o email";
            $this->presenter->render("view/registroView.mustache", ["error" => $error]);
        } else {
            $this->model->agregarUsuario($datos_usuario);

            // Enviar correo de confirmación
            $mailer = new Mailer();
            $to = $datos_usuario['email'];
            $subject = 'Confirmación de Registro';
            $body = 'Gracias por registrarte en nuestro sitio. Por favor, confirma tu correo electrónico haciendo clic en el siguiente enlace: <a href="http://example.com/confirm?token=someToken">Confirmar</a>';
            $result = $mailer->sendEmail($to, $subject, $body);

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
        $nombreUsuario = htmlspecialchars($_POST['nombreUsuario']);
        $password = $_POST['password'];

        $existeUsuario = $this->model->verSiExisteUsuarioPorNombreYPassword($nombreUsuario, $password)[0];

        if ($existeUsuario['usuario_existe'] == 0) {
            $error = "Datos invalidos";
            $this->presenter->render("view/inicioDeSesionView.mustache", ["error" => $error]);
        } else {
            header('location:/ProyectoFinal/index.php?controller=lobby&action=get');
            exit();
        }
    }
}

