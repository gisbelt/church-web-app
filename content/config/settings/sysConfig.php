<?php

namespace config\settings;

define("_ROUTE_", "http://localhost/proyecto-iglesia-uptaeb/");                    /* direccion del proyecto */
define("_THEME_", "http://localhost/proyecto-iglesia-uptaeb/public/assets");                /* Direccion de recursos y estilos */
define("_INDEX_FILE_", "http://localhost/proyecto-iglesia-uptaeb/public/index.php");        /* direccion del archivo index */

define('_COMPONENT_', 'content/component');                                 /* direccion de componentes */
define('_DIRECTORY_', 'content/controllers/');                                /* direccion de controladores */
define("_MODEL_", "content/models/");                                      /* direccion de los modelos */
define("_VIEW_", 'view.php');                                                /* complemento para la llamada de vistas */
define("_CONTROLLER_", 'Controller.php');                                    /* complemento para la llamada de controladores */

define("_DB_SERVER_", 'http://localhost/');                                /* nombre del servidor */

define('_DB_MANAGER_', 'mysql');                                            /* manejador de base de datos */
define("_DB_WEB_", 'iglesia_bd');                                            /* nombre de la base de datos */
define('_DB_HOST_', 'localhost');                                            /* nombre del host */
define("_DB_USER_", 'root');                                                /* nombre del usuario de la base de datos */
define("_DB_PASS_", '123456');                                                    /* contraseña de la base de datos  */
define("_DB_PORT_", '3307');                                               /* puerto de la base de datos  */

class sysConfig
{
    public function _int()
    {
        if (file_exists("./../content/core/aplicacion.php")) {
            require_once("./../content/core/aplicacion.php");
        } else {
            die("./../content/core/aplicacion");
        }
    }

    protected function _ROUTE_()
    {
        return _ROUTE_;
    }

    protected function _THEME_()
    {
        return _THEME_;
    }

    protected function _INDEX_FILE_()
    {
        return _INDEX_FILE_;
    }

    protected function _COMPONENT_()
    {
        return _COMPONENT_;
    }

    protected function _DIRECTORY_()
    {
        return _DIRECTORY_;
    }

    protected function _MODEL_()
    {
        return _MODEL_;
    }

    protected function _VIEW_()
    {
        return _VIEW_;
    }

    protected function _CONTROLLER_()
    {
        return _CONTROLLER_;
    }

    protected function _DB_SERVER_()
    {
        return _DB_SERVER_;
    }

    protected function _DB_WEB_()
    {
        return _DB_WEB_;
    }

    protected function _HOST_()
    {
        return _DB_HOST_;
    }

    protected function _DB_USER_()
    {
        return _DB_USER_;
    }

    protected function _DB_PASS_()
    {
        return _DB_PASS_;
    }
}

?>