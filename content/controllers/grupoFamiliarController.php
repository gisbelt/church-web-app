<?php

namespace content\controllers;

use content\models\usuariosModel as usuarios;
use content\models\grupoFamiliarModel as gf;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarController
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Grupos Familiares';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/grupoFamiliar/consultarView.php')), 200);

    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Grupos Familiares';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/grupoFamiliar/registrarView.php')), 200);
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