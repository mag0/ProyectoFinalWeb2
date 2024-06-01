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
        $nombreCompleto = $datos_usuario['nombreCompleto'];
        $anioDeNacimiento = $datos_usuario['anioDeNacimiento'];
        $genero = $datos_usuario['genero'];
        $pais = $datos_usuario['pais'];
        $ciudad = $datos_usuario['ciudad'];
        $email = $datos_usuario['email'];
        $password = $datos_usuario['password'];
        $nombreUsuario = $datos_usuario['nombreUsuario'];
        $perfil = $datos_usuario['perfil'];
        $fechaRegistro = $datos_usuario['fechaRegistro'];

        $this->database->execute("INSERT INTO usuario (nombreCompleto, anioDeNacimiento, genero, pais, ciudad, email, password, nombreUsuario, perfil, fechaRegistro) 
                                VALUES ('$nombreCompleto', '$anioDeNacimiento', '$genero', '$pais', '$ciudad', 
                                            '$email', '$password', '$nombreUsuario', '$perfil', '$fechaRegistro')");
    }

    public function getUsuario($nombreUsuario)
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario'");
    }
}