<?php

namespace content\controllers;

use content\collections\usuariosCollection;
use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\cargosModel as cargos;
use content\models\rolesModel;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class usuariosController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['consultar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['buscarUsuario']));
    }

    public function index()
    {
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/usuarios/consultarView.php')), 200);
        usuarios::validarLogin();
        $cargos = cargos::obtener_cargos();
        return $this->render('/acceso/usuarios/consultarView', [
            'cargos' => $cargos
        ]);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/registrarView');
    }

    public function consultar()
    {
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/consultarView');
    }

    public function buscarUsuario(){
        $nombreMiembro = $_POST['buscarMiembro'];
        $consultarMiembro = usuarios::buscarMiembro($nombreMiembro);
        die ($consultarMiembro);
    }

    public function obtenerUsuarios()
    {
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $usuarios = usuarios::obtener_usuarios();
        if($usuarios){
            $usuariosCollection = new usuariosCollection();
            $usuariosFormat = $usuariosCollection->formatUsuarios($usuarios);
        } else {
            $usuariosFormat = [];
        }
        $data = [
            'usuarios' => $usuariosFormat,
        ];
        return json_encode($data);
    }
}