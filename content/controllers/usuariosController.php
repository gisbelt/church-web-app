<?php

namespace content\controllers;

use Carbon\Carbon;
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
use content\models\miembrosModel as miembros;
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

    // Editar datos de usuario
    public function actualizar(Request $request)
    {
        usuarios::validarLogin();
        if ($request->isPost()) {
            $usuario = new usuarios();
            $usuario->loadData($request->getBody());
            if ($usuario->validate()) {
                $id = $request->getBody()['id'];
                $username = $request->getBody()['username'];
                $email = $request->getBody()['email'];
                $status = $request->getBody()['status'];
                $fecha = Carbon::now();
                $usuario = usuarios::actualizar($id, $username, $email, $status, $fecha);
                if ($usuario) {
                    $data = [
                        'title' => 'Datos actualizado',
                        'messages' => 'El usuario se ha actualizado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El usuario no se ha actualizado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
        }
        if (count($usuario->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $usuario->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    // Mostrar vista lista usuario
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

    // Mostrar vista crear usuario
    public function create()
    {
        usuarios::validarLogin();
        $miembros = miembros::obtener_miembros();
        $roles = rolesModel::obtener_roles();
        return $this->render('/acceso/usuarios/registrarView', [
            'miembros' => $miembros,
            'roles' => $roles
        ]);
    }

    // Mostrar vista datos de usuario en la lista
    public function obtenerUsuarios(Request $request)
    {
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $cargo = count($request->getBody()) > 1 ? $request->getBody()['cargo'] : null;
        $status = count($request->getBody()) > 1 ? $request->getBody()['status'] : null;
        $miembro = count($request->getBody()) > 1 ? $request->getBody()['miembro'] : null;
        if (!is_null($cargo) || !is_null($status) || !is_null($miembro)) {
            $usuarios = usuarios::obtener_usuarios($cargo, $status, $miembro);
            if ($usuarios) {
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

    // Mostrar vista editar usuario
    public function editar(Request $request)
    {
        $id = $request->getRouteParams();
        $usuario = usuarios::id_usuario($id['id']);
        return $this->render('acceso/usuarios/editarView', [
            'id' => $usuario['id'],
            'username' => $usuario['username'],
            'status' => $usuario['status'],
            'email' => $usuario['email'],
        ]);
    }

    // Guardar datos usuario
    public function guardar(Request $request)
    {
        usuarios::validarLogin();
        $usuario = new usuarios();
        $usuario->loadData($request->getBody());
        if ($usuario->validate()) {
            if($request->getBody()['username'] != ''){
                if ($request->getBody()['password'] == $request->getBody()['password-confirm']) {
                    if ($request->getBody()['miembro'] != '' || $request->getBody()['rol'] != '') {
                        $miembro = $request->getBody()['miembro'];
                        $username = $request->getBody()['username'];
                        $email = $request->getBody()['email'];
                        $rol = $request->getBody()['rol'];
                        $fecha = Carbon::now();
                        $password = password_hash($request->getBody()['password'], PASSWORD_BCRYPT, ['cost' => 10]);
                        $usuario = usuarios::crear($username, $email, $password, $rol, $miembro, $fecha);
                        if ($usuario) {
                            $data = [
                                'title' => 'Datos regidtrado',
                                'messages' => 'El usuario se ha registrado',
                                'code' => 200
                            ];
                        } else {
                            $data = [
                                'title' => 'Error',
                                'messages' => 'El usuario no se ha registrado',
                                'code' => 500
                            ];
                        }
                        return json_encode($data);
                    } else {
                        if (empty($request->getBody()['miembro'])) {
                            $usuario->addError("miembro", "El campo miembro es requerido");
                        }
                        if (empty($request->getBody()['rol'])) {
                            $usuario->addError("rol", "El campo rol es requerido");
                        }
                    }
                } else {
                    $usuario->addError("password", "La contraseña debe ser igual a confirmar contraseña");
                }
            } else {
                $usuario->addError("username", "El campo usuario es requerido");
            }
        }
        $data = [
            'title' => 'Datos invalidos',
            'messages' => $usuario->errors,
            'code' => 422
        ];
        return json_encode($data, 422);
    }

    public function eliminar(Request $request)
    {
        usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $usuario = new usuarios();

        }
    }
}