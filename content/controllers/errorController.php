<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

class errorController
{
    public function __construct()
    {

    }
    
    public function index()
    {
        $user = usuarios::validarLogout();
        $data["titulo"] = "ERROR 500";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/errorView.php')), 200);
    }

}

?>