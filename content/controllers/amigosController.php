<?php

namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosController
{

    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Amigos';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/amigos/consultarView.php')), 200);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar amigos';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/amigos/registrarView.php')), 200);
    }

}

?>