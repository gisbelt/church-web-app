<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;

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
        /*$data['titulo'] = 'Miembros';
        include_once("view/miembros/miembros/consultarView.php");*/
        usuarios::validarLogin();
        return $this->render('miembros/miembros/consultarView');
    }

    public function registrar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Miembros';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/miembros/consultarView.php')), 200);
        return $this->render('miembros/miembros/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Miembros';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/miembros/registrarView.php')), 200);
        return $this->render('miembros/miembros/registrarView');
    }
}

?>