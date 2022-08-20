<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class perfilController
{
    public function __construct()
    {

    }

    public function index()
    {
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Mi Cuenta';
        include_once("view/perfil/cuenta/cuentaView.php");
    }

    public function preferencias()
    {
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Preferencias';
        include_once("view/perfil/preferencias/preferenciasView.php");
    }

}

?>