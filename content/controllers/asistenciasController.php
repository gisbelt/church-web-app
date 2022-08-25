<?php

namespace content\controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class asistenciasController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['titulo'] = 'Bitacora';
        return new RedirectResponse('/home', 302);
        //include_once("view/miembros/amigos/consultarView.php");
    }
}