<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class donacionesController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['titulo'] = 'Donaciones';
        include_once("view/donaciones/consultarView.php");
    }

    public function registrar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Donaciones';
        include_once("view/donaciones/registrarView.php");
    }

    public function consultar()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Donaciones';
        include_once("view/donaciones/consultarView.php");
    }
}

?>