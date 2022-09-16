<?php

namespace content\controllers;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;
use content\models\grupoFamiliarModel as gf;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Grupos Familiares';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/grupoFamiliar/consultarView.php')), 200);
        return $this->render('grupoFamiliar/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $consultarMiembroLista = gf::buscarMiembroLista();
        $data['titulo'] = 'Registrar Grupos Familiares';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/grupoFamiliar/registrarView.php')), 200);
        return $this->render('grupoFamiliar/registrarView');
    }

    public function buscarMiembro(){
        $nombreMiembro = $_POST['nombreMiembro'];
        $consultarMiembro = gf::buscarMiembro($nombreMiembro);
        die ($consultarMiembro);
    }

    public function registrarGrupoFamiliar(){
        $nombreGrupoFamiliar = $_POST['nombreGrupoFamiliar'];
        $miembroId = $_POST['miembroId'];
        gf::registrarGrupoFamiliar($nombreGrupoFamiliar,$miembroId);
    }
}

?>