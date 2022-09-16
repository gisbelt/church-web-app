<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class reportesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware());
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Reportes';
        //include_once("view/reportes/reportesView.php");
        return $this->render('/reportes/reportesView');
    }


}
?>