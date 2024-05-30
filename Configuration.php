<?php
include_once("controller/UsuarioController.php");
include_once("controller/LobbyController.php");

include_once("model/UsuarioModel.php");
include_once("model/LobbyModel.php");

include_once("helper/Database.php");
include_once("helper/Router.php");
include_once("helper/Mailer.php");

include_once("helper/Presenter.php");
include_once("helper/MustachePresenter.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');

class Configuration
{
    // CONTROLLERS
    public static function getUsuarioController()
    {
        return new UsuarioController(self::getUsuarioModel(), self::getPresenter(), self::getMailer());
    }

    public static function getLobbyController()
    {
        return new LobbyController(self::getLobbyModel(), self::getPresenter());
    }

    // MODELS

    private static function getUsuarioModel()
    {
        return new UsuarioModel(self::getDatabase());
    }

    private static function getLobbyModel()
    {
        return new LobbyModel(self::getDatabase());
    }


    // HELPERS
    public static function getDatabase()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }

    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }


    public static function getRouter()
    {
        return new Router("getUsuarioController", "get");
    }

    private static function getPresenter()
    {
        return new MustachePresenter("view/template");
    }

    public static function getMailer()
    {
        return new Mailer();
    }
}
