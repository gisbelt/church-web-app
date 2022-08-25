<?php 
namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class miembrosController {
    public function __construct()
    {
        
    }

    public function index(){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $data['titulo'] = 'Miembros';
        include_once("view/miembros/miembros/consultarView.php");
   }

    public function registrar( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        $user=usuarios::validarLogin(); 
        $data['titulo'] = 'Miembros';       
        include_once("view/miembros/miembros/registrarView.php");
   }

    public function consultar( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        $user=usuarios::validarLogin(); 
        $data['titulo'] = 'Miembros';       
        include_once("view/miembros/miembros/consultarView.php");
    }
}
?>