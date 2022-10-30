<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\homeCollection;
use content\core\Aplicacion;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\homeModel;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class notificacionesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
    }

    public function index()
    {
        if (!in_array(permisos::$home, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        return $this->render('/notificaciones/consultarView');
    }

}

?>