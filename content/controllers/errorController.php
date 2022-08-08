<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

class errorController{
    public function index(){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user=usuarios::validarLogout();
        $data["titulo"] = "ERROR 500";
        require_once("view/errorView.php");
    }

}
?>