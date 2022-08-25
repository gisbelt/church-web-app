<?php 
namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class reportesController {
    public function __construct()
    {
        
    }

    public function index(){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $user=usuarios::validarLogin();
        $data['titulo'] = 'Reportes';
        include_once("view/reportes/reportesView.php");
   }


}
?>