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
                                                   nombre_usuario = '$nombreUsuario' OR email = '$email'");
    }

    public function verSiExisteUsuarioPorNombreYPassword($nombreUsuario,$password)
    {
        return $this->database->query("SELECT COUNT(*) AS usuario_existe FROM usuario WHERE 
                                                   nombre_usuario = '$nombreUsuario' OR password = '$password'");
    }

    public function agregarUsuario($nombre, $email, $password)
    {
        $this->database->execute("INSERT INTO usuario (nombre_usuario, email, password) VALUES ('$nombre', '$email', '$password')");
    }
}