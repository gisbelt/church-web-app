<?php

namespace content\controllers;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class seguridadController
 * @var content\controllers
 */
class seguridadController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        if(!in_array(permisos::$seguridad, $_SESSION['user_permisos'])){
            throw new ForbiddenException();
        }
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        return $this->render('seguridad/consultarView');
    }

    public function update()
    {
        $user = usuarios::validarLogin();
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        //return $this->render('seguridad/consultarView');
    }
}