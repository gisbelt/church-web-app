<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\cargosModel;
use content\models\membresiasModel;
use content\models\usuariosModel as usuarios;
use content\models\profesionModel;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class miembrosController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['registrar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        /*$data['titulo'] = 'Miembros';
        include_once("view/miembros/miembros/consultarView.php");*/
        usuarios::validarLogin();
        return $this->render('miembros/miembros/consultarView');
    }

    public function registrar()
    {
        $user = usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        return $this->render('miembros/miembros/consultarView', [
            'profesiones' => $profesiones
        ]);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        $membresias = membresiasModel::obtener_membresias();
        $cargos = cargosModel::obtener_cargos();
        return $this->render('miembros/miembros/registrarView', [
            'profesiones' => $profesiones,
            'membresias' => $membresias,
            'cargos' => $cargos
        ]);
    }
}

?>