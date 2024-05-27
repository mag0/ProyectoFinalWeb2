<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function verSiExisteUsuarioPorNombreEEmail($nombreUsuario,$email)
    {
        return $this->database->query("SELECT COUNT(*) AS usuario_existe FROM usuario WHERE 
                                                   nombreUsuario = '$nombreUsuario' OR email = '$email'");
    }

    public function verSiExisteUsuarioPorNombreYPassword($nombreUsuario,$password)
    {
        return $this->database->query("SELECT COUNT(*) AS usuario_existe FROM usuario WHERE 
                                                   nombreUsuario = '$nombreUsuario' AND password = '$password'");
    }

    public function agregarUsuario($datos_usuario)
    {
        $nombreCompleto = $_POST['nombreCompleto'];
        $anioDeNacimiento = $_POST['nombreUsuario'];
        $genero = $_POST['genero'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nombreUsuario = $_POST['nombreUsuario'];
        $perfil = $_POST['perfil'];
        $fechaRegistro = $_POST['fechaRegistro'];
        $this->database->execute("INSERT INTO usuario (nombreCompleto, anioDeNacimiento, genero, pais, ciudad, email, password, nombreUsuario, perfil, fechaRegistro) 
                                    VALUES ('$nombreCompleto', '$anioDeNacimiento', '$genero', '$pais', '$ciudad', 
                                                '$email', '$password', '$nombreUsuario', '$perfil', '$fechaRegistro')");
    }
}