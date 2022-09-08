<?php

namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class donacionesController
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Donaciones';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/donaciones/consultarView.php')), 200);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Donaciones';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/donaciones/registrarView.php')), 200);
    }

}

?>