<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\seguridadCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\permisosModel;
use content\models\rolesModel;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class seguridadController
 * @var content\controllers
 */
class seguridadController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
    }

    public function actualizar(Request $request)
    {
        $user = usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new permisosModel();
            $seguridad->loadData($request->getBody());
            if($seguridad->validate()){
                $nombre = $request->getBody()['nombre'];
                $id = $request->getBody()['permiso'];
                $fecha =  Carbon::now();
                $seguridad = permisosModel::actualizar_permiso($id, $nombre, $fecha);
                if($seguridad){
                    $data = [
                        'title' => 'Datos actualizado',
                        'messages' => 'El permiso se ha actualizado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El permiso no se ha actualizado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
        }
        if(count($seguridad->errors) > 0){
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $seguridad->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        return $this->render('seguridad/permisos/consultarView');
    }

    public function obtenerPermisos()
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $permisos = permisosModel::obtener_permisos();

        if($permisos){
            $seguridaCollection = new seguridadCollection();
            $permisosFormat = $seguridaCollection->formatPermisos($permisos);
        } else {
            $permisosFormat = [];
        }
        $data = [
            'permisos' => $permisosFormat,
        ];
        return json_encode($data);
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        return $this->render('seguridad/permisos/registrarView');
    }

    public function guardar(Request $request)
    {
        $user = usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new permisosModel();
            $seguridad->loadData($request->getBody());

            if($seguridad->validate()){
                $nombre = $request->getBody()['nombre'];
                $fecha =  Carbon::now();
                $seguridad = permisosModel::agregar_permiso($nombre, $fecha);
                if($seguridad){
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'El permiso se ha registrado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El permiso no se ha registrado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
        }
        if(count($seguridad->errors) > 0){
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $seguridad->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function editar(Request $request)
    {
        $user = usuarios::validarLogin();
        //if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
        //    throw new ForbiddenException();
       // }
        $id = $request->getRouteParams();
        $permiso = permisosModel::id_permiso($id['id']);
        return $this->render('seguridad/permisos/editarView', [
            'permiso' => $permiso['permiso'],
            'nombre_permiso' => $permiso['permiso_nombre'],
        ]);
    }

    public function eliminar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $permiso = permisosModel::eliminar($id);
            if($permiso){
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'El permiso se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El permiso no se ha eliminado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        $data = [
            'title' => 'Error',
            'messages' => 'Algo salio mal intente mas tardes',
            'code' => 422
        ];
        return json_encode($data, 422);
    }

    public function actualizarRol(Request $request)
    {
        $user = usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new permisosModel();
            $seguridad->loadData($request->getBody());
            if($seguridad->validate()){
                $nombre = $request->getBody()['nombre'];
                $id = $request->getBody()['rol'];
                $fecha =  Carbon::now();
                $seguridad = rolesModel::actualizar_rol($id, $nombre, $fecha);
                if($seguridad){
                    $data = [
                        'title' => 'Datos actualizado',
                        'messages' => 'El rol se ha actualizado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El rol no se ha actualizado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
        }
        if(count($seguridad->errors) > 0){
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $seguridad->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function indexRol()
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        return $this->render('seguridad/roles/consultarView');
    }

    public function obtenerRoles()
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        //$logger->debug(__METHOD__, ['roles']);
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $roles = rolesModel::obtener_roles();
        if($roles){
            $seguridaCollection = new seguridadCollection();
            $rolesFormat = $seguridaCollection->formatRoles($roles);
        } else {
            $rolesFormat = [];
        }
        $data = [
            'roles' => $rolesFormat,
        ];
        return json_encode($data);

    }

    public function createRol()
    {
        $user = usuarios::validarLogin();
        /*$data["titulo"] = "Home";
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/homeView.php')), 200);*/
        return $this->render('seguridad/roles/registrarView');
    }

    public function guardarRol(Request $request)
    {
        $user = usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new permisosModel();
            $seguridad->loadData($request->getBody());

            if($seguridad->validate()){
                $fecha =  Carbon::now();
                $nombre = $request->getBody()['nombre'];
                $seguridad = rolesModel::agregar_rol($nombre, $fecha);
                if($seguridad){
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'El rol se ha registrado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El rol no se ha registrado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
        }
        if(count($seguridad->errors) > 0){
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $seguridad->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function editarRol(Request $request)
    {
        $user = usuarios::validarLogin();
        //if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
        //    throw new ForbiddenException();
        // }
        $id = $request->getRouteParams();
        $rol = rolesModel::id_rol($id['id']);
        return $this->render('seguridad/roles/editarView', [
            'rol' => $rol['rol'],
            'role_nombre' => $rol['role_nombre'],
        ]);
    }

    public function eliminarRol(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $rol = rolesModel::eliminar($id);
            if($rol){
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'El rol se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El rol no se ha eliminado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        $data = [
            'title' => 'Error',
            'messages' => 'Algo salio mal intente mas tardes',
            'code' => 422
        ];
        return json_encode($data, 422);
    }
}