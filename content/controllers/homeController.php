<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Response;

class homeController
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);
    }

}

?>
