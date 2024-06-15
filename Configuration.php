<?php
include_once("controller/UsuarioController.php");
include_once("controller/LobbyController.php");
include_once("controller/PartidaController.php");
include_once("controller/AdminController.php");
include_once("controller/EditorController.php");

include_once("model/UsuarioModel.php");
include_once("model/LobbyModel.php");
include_once("model/PartidaModel.php");
include_once("model/EditorModel.php");
include_once("model/AdminModel.php");

include_once("helper/Database.php");
include_once("helper/Router.php");

include_once("helper/Presenter.php");
include_once("helper/MustachePresenter.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');
include_once('vendor/PHPMailer/src/PHPMailer.php');
include_once('vendor/PHPMailer/src/Exception.php');
include_once('vendor/PHPMailer/src/SMTP.php');

class Configuration
{
    // CONTROLLERS
    public static function getUsuarioController()
    {
        return new UsuarioController(self::getUsuarioModel(), self::getPresenter());
    }

    public static function getLobbyController()
    {
        return new LobbyController(self::getLobbyModel(), self::getPresenter());
    }

    public static function getPartidaController()
    {
        return new PartidaController(self::getPartidaModel(), self::getPresenter());
    }

    public static function getAdminController()
    {
        return new AdminController(self::getAdminModel(), self::getPresenter());
    }

    public static function getEditorController()
    {
        return new EditorController(self::getEditorModel(), self::getPresenter());
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

    private static function getPartidaModel()
    {
        return new PartidaModel(self::getDatabase());
    }

    private static function getAdminModel()
    {
        return new AdminModel(self::getDatabase());
    }

    private static function getEditorModel()
    {
        return new EditorModel(self::getDatabase());
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
}
