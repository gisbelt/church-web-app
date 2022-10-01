<?php

namespace content\controllers;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\cargosModel;
use content\models\membresiasModel;
use content\models\usuariosModel as usuarios;
use content\models\profesionModel;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class miembrosController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['registrar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        return $this->render('miembros/miembros/consultarView');
    }

    public function registrar()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        return $this->render('miembros/miembros/consultarView', [
            'profesiones' => $profesiones
        ]);
    }

    public function create()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        $membresias = membresiasModel::obtener_membresias();
        $cargos = cargosModel::obtener_cargos();
        return $this->render('miembros/miembros/registrarView', [
            'profesiones' => $profesiones,
            'membresias' => $membresias,
            'cargos' => $cargos
        ]);
    }

    public function guardar(Request $request)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, ['llegando']);
    }
}