<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuario($nombreUsuario)
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario'");
    }

    public function verSiExisteUsuarioPorNombreEEmail($nombreUsuario, $email)
    {
        return $this->database->query("SELECT COUNT(*) AS usuario_existe FROM usuario WHERE 
                                                   nombreUsuario = '$nombreUsuario' OR email = '$email'");
    }

    public function verSiExisteUsuarioPorNombreYPassword($nombreUsuario, $password)
    {
        return $this->database->query("SELECT COUNT(*) AS usuario_existe FROM usuario WHERE 
                                                   nombreUsuario = '$nombreUsuario' AND password = '$password'");
    }

    public function signIn($email, $password)
    {
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND password = '$password' AND cuenta_validada = 1";
        return $this->database->query($sql);
    }

    public function verificarUsuario($token, $email)
    {
        $tokenDB = $this->database->query("SELECT token FROM usuario WHERE email = '$email'");

        if ($tokenDB[0]['token'] === $token) {
            $this->database->execute("UPDATE usuario SET cuenta_validada = b'1' WHERE email = '$email'");
            return true;
        } else {
            return false;
        }
    }

    public function agregarUsuario($datos_usuario)
    {
        $nombreCompleto = $datos_usuario['nombreCompleto'];
        $anioDeNacimiento = $datos_usuario['anioDeNacimiento'];
        $genero = $datos_usuario['genero'];
        $pais = $datos_usuario['pais'];
        $ciudad = $datos_usuario['ciudad'];
        $email = $datos_usuario['email'];
        $password = $datos_usuario['password'];
        $nombreUsuario = $datos_usuario['nombreUsuario'];
        $foto = $datos_usuario['foto'];
        $fechaRegistro = $datos_usuario['fechaRegistro'];
        $token = $datos_usuario['token'];

        $this->database->execute("INSERT INTO usuario (nombreCompleto, anioDeNacimiento, genero, pais, ciudad, email, password, nombreUsuario, foto, fechaRegistro, puntaje_total, token) 
                        VALUES ('$nombreCompleto', '$anioDeNacimiento', '$genero', '$pais', '$ciudad', 
                                    '$email', '$password', '$nombreUsuario', '$foto', '$fechaRegistro', 0, '$token')");
    }
}
