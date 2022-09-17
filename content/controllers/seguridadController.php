<?php

namespace content\controllers;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;

/**
 * Class seguridadController
 * @var content\controllers
 */
class seguridadController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['update']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        return $this->render('seguridad/consultarView');
    }

    public function update()
    {
        $user = usuarios::validarLogin();
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        return $this->render('seguridad/consultarView');
    }
}