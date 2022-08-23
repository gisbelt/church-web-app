<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class usuariosController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['titulo'] = 'Usuarios';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/usuarios/consultarView.php')), 200);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar usuarios';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/usuarios/registrarView.php')), 200);
    }

    public function consultar()
    {
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Usuarios';
        include_once("view/acceso/usuarios/consultarView.php");
    }


}

?>