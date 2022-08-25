<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['titulo'] = 'Grupo Familiar';
        include_once("view/grupoFamiliar/consultarView.php");

    }

    public function registrar()
    {
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Grupo Familiar';
        include_once("view/grupoFamiliar/registrarView.php");
    }

    public function consultar()
    {
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Grupo Familiar';
        include_once("view/grupoFamiliar/consultarView.php");
    }
}

?>