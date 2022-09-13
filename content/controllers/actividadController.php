<?php

namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class actividadController
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Actividades';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/donacactividadesiones/consultarView.php')), 200);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Actividades';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/actividades/registrarView.php')), 200);
    }

}