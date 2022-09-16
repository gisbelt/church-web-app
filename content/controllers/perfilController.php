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

class perfilController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['preferencias']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Mi Cuenta';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/perfil/cuenta/cuentaView.php')), 200);
        return $this->render('/perfil/cuenta/cuentaView');
    }

    public function preferencias()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Preferencias';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/perfil/preferencias/preferenciasView.php')), 200);
        return $this->render('/perfil/preferencias/preferenciasView');
    }

}

?>