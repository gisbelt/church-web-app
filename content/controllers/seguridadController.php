<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\seguridadCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\bitacoraModel;
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
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerPermisos']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['configurar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizarRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['indexRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerRoles']));
        $this->registerMiddleware(new AutenticacionMiddleware(['createRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardarRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editarRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminarRol']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminarRol']));
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
                    bitacoraModel::guardar('Actualizo el permiso:'. $nombre, 'Seguridad actualizar permiso');
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
        if (!in_array(permisos::$seguridad_permisos, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        bitacoraModel::guardar('Ingreso a lista permiso', 'Index permiso');
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
        if (!in_array(permisos::$seguridad_permisos, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso a crear permiso', 'Crear permiso');
        $user = usuarios::validarLogin();
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
                    bitacoraModel::guardar('Registro el permiso permiso:'. $nombre, 'Registro permiso');
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
        if (!in_array(permisos::$seguridad_permisos, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParams();
        $permiso = permisosModel::id_permiso($id['id']);
        bitacoraModel::guardar('Ingreso en actualizar permiso:'. $id['id'], 'Actualiar permiso');
        return $this->render('seguridad/permisos/editarView', [
            'permiso' => $permiso['permiso'],
            'nombre_permiso' => $permiso['permiso_nombre'],
        ]);
    }

    public function eliminar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad_permisos, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $permiso = permisosModel::eliminar($id);
            if($permiso){
                bitacoraModel::guardar('Elimino el permiso:'. $id, 'Elimino permiso');
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

    public function configurar()
    {
        if (!in_array(permisos::$seguridad_permisos, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        // $roles = rolesModel::getRoleUser($_SESSION['user']);
        // $permisos = permisosModel::obtener_permisos();
        // $usuarios = permisosModel::obtener_usuarios();
        bitacoraModel::guardar('Ingresó a configurar permisos', 'Configurar Permisos');
        return $this->render('seguridad/permisos/configurarView');
    }

    public function obtener_usuarios()
    {
        try {
            $usuarios = permisosModel::obtener_usuarios();
            if($usuarios){
                $permisosColletion = new seguridadCollection();
                $permisosFormat = $permisosColletion->formatConfigurar($usuarios);
            } else {
                $permisosFormat = [
                    'usuarios' => [],
                ];
            }
            $data = [
                'usuarios' => $permisosFormat['usuarios'],
            ];
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }

    public function obtener_rol_user()
    {
        try {
            $id = $request->getRouteParams();
            $roles = rolesModel::getRoleUser($id['id']);
            $data = [
                'rol' => $roles['rol'],
                'rol_nombre' => $roles['rol_nombre']
            ];
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }

    public function actualizarRol(Request $request)
    {
        usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new permisosModel();
            $seguridad->loadData($request->getBody());
            if($seguridad->validate()){
                $nombre = $request->getBody()['nombre'];
                $id = $request->getBody()['rol'];
                $fecha =  Carbon::now();
                $seguridad = rolesModel::actualizar_rol($id, $nombre, $fecha);
                if($seguridad){
                    bitacoraModel::guardar('Actualizo el rol:'. $nombre, 'Actualizar rol');
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
        if (!in_array(permisos::$seguridad_roles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        bitacoraModel::guardar('Ingreso en lista roles', 'Index rol');
        return $this->render('seguridad/roles/consultarView');
    }

    public function obtenerRoles()
    {
        $user = usuarios::validarLogin();
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
        if (!in_array(permisos::$seguridad_roles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso en crear roles', 'Crear rol');
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
                    bitacoraModel::guardar('Registro rol'. $nombre, 'Creo el rol');
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
        if (!in_array(permisos::$seguridad_roles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParams();
        $rol = rolesModel::id_rol($id['id']);
        bitacoraModel::guardar('Ingreso en editar rol'. $id, 'Actualizar rol');
        return $this->render('seguridad/roles/editarView', [
            'rol' => $rol['rol'],
            'role_nombre' => $rol['role_nombre'],
        ]);
    }

    public function eliminarRol(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad_roles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $rol = rolesModel::eliminar($id);
            if($rol){
                bitacoraModel::guardar('Elimino el rol'. $id, 'Eliminar rol');
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