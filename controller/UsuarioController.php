<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            "perfil" => '',
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
            $img = "";
            if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
                $nuevoNombre = time();
                $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
                $destino = "public/uploads/" . $nuevoNombre . "." . $extension;
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)) {
                    $img = "$nuevoNombre.$extension";
                }
            }

            $token = uniqid(); /* Para generar un identificador único  */

            $datos_usuario['perfil'] = $img;
            $datos_usuario['token'] = $token;

            $result = $this->model->agregarUsuario($datos_usuario);

            if (!$result && !empty($img)) {
                unlink("public/uploads/" . $img);
            }

            if ($this->enviarEmailRegistro($datos_usuario['email'], $datos_usuario['nombreCompleto'], $token)) {
                $this->presenter->render("view/inicioDeSesionView.mustache", ["success" => "Se envió un correo de verificación."]);
            } else {
                $error = "Hubo un problema al enviar el correo de confirmación. Por favor, inténtelo de nuevo.";
                $this->presenter->render("view/registroView.mustache", ["error" => $error]);
            }
        }
    }

    public function enviarEmailRegistro($email, $nombre)
    {
        $enlaceVerificacion = 'http://localhost/ProyectoFinal/index.php';

        $mailer = new PHPMailer(true);
        try {
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'angeldnk25@gmail.com';
            $mailer->Password = 'squxouuwbamxirry
';
            $mailer->Port = 587;

            $mailer->setFrom('angeldnk25@gmail.com', 'Preguntovich');
            $mailer->addAddress($email, $nombre);

            $mailer->isHTML(true);
            $mailer->Subject = 'Verificacion de Registro en Preguntovich';
            $mailer->Body = '<h1>¡Hola ' . $nombre . '!</h1><br> <h3>¡Gracias por registrarte! <br></br> Por favor, haz clic en el siguiente enlace para verificar tu cuenta: <a href="' . $enlaceVerificacion . '">Verificar cuenta</a></h3>';
            $mailer->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function verificarUsuario()
    {
        $token = $_GET['token'];
        $email = $_GET['email'];

        if (empty($token) || empty($email)) {
            header('Location:/error?codError=333');
            exit();
        } else {
            $usuarioVerificado = $this->model->verificarUsuario($token, $email);
            if ($usuarioVerificado) {
                header('Location: /login?EXITO=1');
            } else {
                header('Location:/error?codError=333');
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
            session_start();
            $_SESSION['usuarioActivo'] = $this->model->getUsuario($nombreUsuario)[0];
            header('location:/ProyectoFinal/index.php?controller=lobby&action=get');
            exit();
        }
    }

    public function salir()
    {
        session_start();
        session_destroy();
        header("location:/ProyectoFinal/index.php?controller=usuario&action=get");
        exit();
    }
}