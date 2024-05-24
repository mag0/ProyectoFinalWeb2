<?php
include_once("controller/InicioDeSesionController.php");

include_once("model/InicioDeSesionModel.php");

include_once("helper/Database.php");
include_once("helper/Router.php");

include_once("helper/Presenter.php");
include_once("helper/MustachePresenter.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');

class Configuration
{
    // CONTROLLERS
    public static function getInicioDeSesionController()
    {
        return new InicioDeSesionController(self::getInicioDeSesionModel(), self::getPresenter());
    }

    // MODELS

    private static function getInicioDeSesionModel()
    {
        return new InicioDeSesionModel(self::getDatabase());
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
        return new Router("getInicioDeSesionController", "get");
    }

    private static function getPresenter()
    {
        return new MustachePresenter("view/template");
    }
}
