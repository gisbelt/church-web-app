<?php

namespace content\controllers;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\donacionesModel as donacion;
use content\models\miembrosModel as miembros;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class donacionesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        if(!in_array(permisos::$donaciones, $_SESSION['user_permisos'])){
            throw new ForbiddenException();
        }

        return $this->render('donaciones/consultarView');
    }

    public function create()
    {
        if(!in_array(permisos::$donaciones, $_SESSION['user_permisos'])){
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();

        $tipoDonacion = donacion::tipo_donaciones();
        $miembros = miembros::obtener_miembros();
        return $this->render('donaciones/registrarView', [
            'tipo_donaciones' => $tipoDonacion,
            'miembros' => $miembros
        ]);
    }

    public function guardar(Request $request)
    {
        if(!in_array(permisos::$donaciones, $_SESSION['user_permisos'])){
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$request->getBody()]);

    }

}

?>