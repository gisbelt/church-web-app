<?php
namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class reportesController {
    public function __construct()
    {
    
    }

    public function index(){
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Reportes';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/reportes/reportesView.php')), 200);
   }


}
?>