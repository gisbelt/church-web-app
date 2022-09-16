<?php

namespace content\controllers;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class asistenciasController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Asistencias';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/asistencias/consultarView.php')), 200);
        return $this->render('asistencias/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Asistencias';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/asistencias/registrarView.php')), 200);
        return $this->render('asistencias/registrarView');
    }
}