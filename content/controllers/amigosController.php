<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosController
{

    public function __construct()
    {

    }

    public function index()
    {
        $data['titulo'] = 'Amigos';
        include_once("view/miembros/amigos/consultarView.php");
    }

    public function registrar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registra amigos';
        include_once("view/miembros/amigos/registrarView.php");
    }

    public function consultar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Consultar amigos';
        include_once("view/miembros/amigos/consultarView.php");
    }
}

?>