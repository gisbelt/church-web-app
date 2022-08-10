<?php 
namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class usuariosController {
    public function __construct()
    {   
        
    }

    public function index(){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        $data['titulo'] = 'Usuarios';
        include_once("view/acceso/usuarios/consultarView.php");
   }

    public function registrar( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        $user=usuarios::validarLogin();
        $data['titulo'] = 'Usuarios';        
        include_once("view/acceso/usuarios/registrarView.php");
   }

    public function consultar( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        $user=usuarios::validarLogin();  
        $data['titulo'] = 'Usuarios';      
        include_once("view/acceso/usuarios/consultarView.php");
    }

    
}
?>