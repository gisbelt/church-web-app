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
        include_once("view/miembros/miembros/registrarView.php");
    }

    public function consultar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Miembros';
        include_once("view/miembros/miembros/consultarView.php");
    }
}

?>