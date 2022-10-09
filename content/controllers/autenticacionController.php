<?php

namespace content\controllers;

use content\core\Aplicacion;
use content\core\Request;
use content\core\Controller;
use content\enums\seguridad;
use content\models\permisosModel;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 *  Class autenticacionController
 *
 *  * @package content\controllers
 */
class AutenticacionController extends Controller
{

    /**
     * Autenticacion construct
     *
     *
     */
    public function __construct()
    {

    }

    public function index()
    {
        usuarios::validarLogout();
        $this->setLayout('auth');
        return $this->render('acceso/login/loginView');
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/login/loginView.php')), 200);
    }

    public function iniciar(Request $request)
    {
        if ($request->isPost()) {
            $usuarioModel = new usuarios();
            $usuarioModel->loadData($request->getBody());
            $email = $request->getBody()['email'];
            $password = $request->getBody()['password'];
            if ($usuarioModel->validate()) {
                $consultarUsuario = $usuarioModel::login($email);
                if ($consultarUsuario && password_verify($password, $consultarUsuario['password'])) {
                    $_SESSION['email'] = 'ok';
                    $_SESSION['user'] = $consultarUsuario['id'];
                    $_SESSION['user_email'] = $consultarUsuario['email'];
                    $_SESSION['username'] = $consultarUsuario['username'];
                    $_SESSION['date'] = date('d_m_Y_H_i');
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['rol'] = seguridad::getRolName($consultarUsuario['role_id']);

                    $seguirdadModel = new permisosModel();
                    $permisos = $seguirdadModel->getRolePermissionUser($consultarUsuario['role_id']);
                    $userPermisos = [];
                    foreach ($permisos as $permiso) {
                        $userPermisos[] = (int)$permiso['permiso'];
                    }

                    $_SESSION['user_permisos'] = $userPermisos;

                    $data = [
                        'title' => 'Bienvenido',
                        'messages' => 'En breve le dirigiremos al panel de control',
                        'code' => 200,
                        'route' => '/home'
                    ];
                    return json_encode($data);
                } else {
                    if (!$consultarUsuario || !password_verify($password, $consultarUsuario['password'])) {
                        $usuarioModel->addError("datos", "El correo o contraseña incorrectos");
                    }

                    $data = [
                        'title' => 'Verifique sus datos',
                        'messages' => $usuarioModel->errors,
                        'code' => 422
                    ];
                    return json_encode($data);
                }
            }
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $usuarioModel->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function cerrarSesion()
    {
        unset($_SESSION['email']);
        unset($_SESSION['user_email']);
        unset($_SESSION['username']);
        unset($_SESSION['date']);
        unset($_SESSION['ip']);
        unset($_SESSION['rol']);
        session_destroy();
        Aplicacion::$app->response->redirect('/');
    }

    public function cambiarContrasena(Request $request)
    {
        usuarios::validarLogout();
        $this->setLayout('auth');
        $id = $request->getRouteParam('id');
        return $this->render('acceso/login/resetPasswordView', [
            'id' => $id
        ]);
    }

    public function recuperarContrasena()
    {
        usuarios::validarLogout();
        $data = [
            'name' => 'Clave Olvidada'
        ];
        $this->setLayout('auth');
        return $this->render('acceso/login/forgotPasswordView', $data);
    }

    public function verificarCorreo(Request $request)
    {
        try {
            $correo = $request->getBody()['correo'];
            $usuarioModel = new usuarios();
            if (!empty($correo)) {
                $existeCorreo = $usuarioModel::login($correo);
                if ($existeCorreo) {
                    $data = [
                        'title' => 'Correo',
                        'messages' => 'En breve sera redirigido',
                        'route' => '/cambiar-contrasena/' . $existeCorreo['id'],
                        'code' => 200,
                    ];
                } else {
                    $data = [
                        'title' => 'Correo',
                        'messages' => 'Por favor verifique, no se encontro este correo:' . $correo,
                        'code' => 404,
                    ];
                }
                return json_encode($data);
            } else {
                $usuarioModel->addError("correo", "Por favor ingrese el correo");
                $data = [
                    'title' => 'Campo vacio',
                    'messages' => $usuarioModel->errors,
                    'code' => 422
                ];
                return json_encode($data);
            }
        } catch (\Exception $ex) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex, 'request' => $request]);
            $data = [
                'title' => 'Error',
                'messages' => $ex,
                'code' => 403
            ];
            return json_encode($data);
        }
    }

    public function resetearContrasena(Request $request)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$request->getBody()]);
        try {
            $usuarioModel = new usuarios();
            $clave = $request->getBody()['clave'];
            $ConfirmarClave = $request->getBody()['confirmar-clave'];
            if ($clave == $ConfirmarClave && strlen($clave) == strlen($ConfirmarClave)) {
                $nuevaClave = password_hash($request->getBody()['clave'], PASSWORD_BCRYPT, ['cost' => 10]);
                $id = $request->getBody()['user'];
                $update = $usuarioModel::actualizarClave($id, $nuevaClave);
                if ($update) {
                    $data = [
                        'title' => 'Contraseña restablecida',
                        'messages' => 'Contraseña restablecida exitosamente',
                        'code' => 200,
                        'route' => '/'
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'Algo salio mal intente mas tardes',
                        'code' => 404,
                    ];
                }
                return json_encode($data);
            } else {
                if ($clave !== $ConfirmarClave) {
                    $usuarioModel->addError("clave", "La clave debe ser igual a confirmar contraseña");
                    $usuarioModel->addError("clave", "La longitud mínima debe ser 6");
                    $usuarioModel->addError("clave", "La longitud maxima debe ser 16");
                }
                $data = [
                    'title' => 'Campo vacio',
                    'messages' => $usuarioModel->errors,
                    'code' => 422
                ];
                return json_encode($data);
            }
        } catch (\Exception $ex) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex, 'request' => $request]);
            $data = [
                'title' => 'Error',
                'messages' => $ex,
                'code' => 403
            ];
            return json_encode($data);
        }
    }
}

?>