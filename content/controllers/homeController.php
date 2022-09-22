<?php

namespace content\controllers;

use content\core\Aplicacion;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;


class homeController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        return $this->render('homeView');

    }


}

?>