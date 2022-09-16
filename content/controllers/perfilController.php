<?php

namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class perfilController
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Mi Cuenta';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/perfil/cuenta/cuentaView.php')), 200);
    }

    public function preferencias()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Preferencias';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/perfil/preferencias/preferenciasView.php')), 200);
    }

}

?>