<?php

namespace content\controllers;

use content\collections\usuariosCollection;
use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\cargosModel as cargos;
use content\models\miembrosModel;
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
        $miembros = miembrosModel::obtener_miembros();
        return $this->render('/acceso/usuarios/consultarView', [
            'cargos' => $cargos,
            'miembros' => $miembros
        ]);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/registrarView');
    }

    public function buscarUsuario(){
        $nombreMiembro = $_POST['buscarMiembro'];
        $consultarMiembro = usuarios::buscarMiembro($nombreMiembro);
        die ($consultarMiembro);
    }

    public function obtenerUsuarios(Request $request)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));

        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $cargo =  count($request->getBody()) > 1 ? $request->getBody()['cargo'] : null;
        $status = count($request->getBody()) > 1 ? $request->getBody()['status'] : null;
        $miembro = count($request->getBody()) > 1 ? $request->getBody()['miembro'] : null;
        if(!is_null($cargo) || !is_null($status) || !is_null($miembro)) {
            $usuarios = usuarios::obtener_usuarios($cargo, $status, $miembro);
            if($usuarios){
                $usuariosCollection = new usuariosCollection();
                $usuariosFormat = $usuariosCollection->formatUsuarios($usuarios);
            } else {
                $usuariosFormat = [];
            }
            $data = [
                'usuarios' => $usuariosFormat,
            ];
        } else {
            $data = [
                'usuarios' => [],
            ];
        }

        return json_encode($data);
    }
}