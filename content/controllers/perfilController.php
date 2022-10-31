<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\exception\ForbiddenException;
use content\core\Request;
use content\enums\permisos;
use content\models\usuariosModel as usuarios;
use content\models\cuentaModel;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class perfilController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['preferencias']));
    }

    public function index()
    {
        if (!in_array(permisos::$perfiles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        return $this->render('/perfil/cuenta/cuentaView');
    }

    public function preferencias()
    {
        if (!in_array(permisos::$perfiles, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Preferencias';
        return $this->render('/perfil/preferencias/preferenciasView');
    }

    public function obtener_usuario()
    {
        try {
            $email = !empty($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
            $usuario = cuentaModel::obtener_usuario_correo($email);
            if (!is_null($usuario)) {
                return json_encode($usuario);
            } else {
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$usuario]);
                return json_encode([]);
            }
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }
    }

    //username
    public function actualizar_username(Request $request)
    {
        usuarios::validarLogin();
        $usuario = new cuentaModel();
        $usuario->loadData($request->getBody());
        if (!empty($request->getBody()['username'])) {
            $username = $request->getBody()['username'];
            $fecha = Carbon::now();
            $email = $_SESSION['user_email'];
            $usuario = cuentaModel::actualizar_username($username, $fecha, $email);
            if ($usuario) {
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'El nombre de usuario se actualizó correctamente',
                    'username' => cuentaModel::obtener_username($email),
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El nombre de usuario no se pudo actualizar',
                    'code' => 422
                ];
            }
            return json_encode($data);
        } else {
            if (empty($request->getBody()['username'])) {
                $usuario->addError("username", "El campo username es requerido");
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

    //nombre
    public function actualizar_nombre(Request $request)
    {
        usuarios::validarLogin();
        $usuario = new cuentaModel();
        $usuario->loadData($request->getBody());
        if (!empty($request->getBody()['nombre']) && !empty($request->getBody()['apellido'])) {
            $nombre = $request->getBody()['nombre'];
            $apellido = $request->getBody()['apellido'];
            $fecha = Carbon::now();
            $email = $_SESSION['user_email'];
            $usuario = cuentaModel::actualizar_nombre($nombre, $apellido, $fecha, $email);
            if ($usuario) {
                $nombre_completo = cuentaModel::obtener_nombre($email);
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'El nombre se actualizó correctamente',
                    'nombre_completo' => $nombre_completo,
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El nombre no se pudo actualizar',
                    'code' => 422
                ];
            }
            return json_encode($data);
        } else {
            if (empty($request->getBody()['nombre']) && empty($request->getBody()['apellido'])) {
                $usuario->addError("nombre", "El campo nombre es requerido");
                $usuario->addError("apellido", "El campo apellido es requerido");
            } else if (empty($request->getBody()['nombre'])) {
                $usuario->addError("nombre", "El campo nombre es requerido");
            } else if (empty($request->getBody()['apellido'])) {
                $usuario->addError("apellido", "El campo apellido es requerido");
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

    //telefono
    public function actualizar_telefono(Request $request)
    {
        usuarios::validarLogin();
        $usuario = new cuentaModel();
        $usuario->loadData($request->getBody());
        if (!empty($request->getBody()['telefono']) && strlen($request->getBody()['telefono']) <= 14 && strlen($request->getBody()['telefono']) >= 10) {
            $telefono = $request->getBody()['telefono'];
            $fecha = Carbon::now();
            $email = $_SESSION['user_email'];
            $usuario = cuentaModel::actualizar_telefono($telefono, $fecha, $email);
            if ($usuario) {
                $telefono = cuentaModel::obtener_telefono($email);
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'El telefono se actualizó correctamente',
                    'telefono' => $telefono,
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El telefono no se pudo actualizar',
                    'code' => 422
                ];
            }
            return json_encode($data);
        } else {
            if (empty($request->getBody()['telefono']) && strlen($request->getBody()['telefono']) < 10 && strlen($request->getBody()['telefono']) > 14) {
                $usuario->addError("telefono", "El campo telefono es requerido");
                $usuario->addError("telefono", "La longitud mínima del telefono debe ser 10");
                $usuario->addError("telefono", "La longitud máxima del telefono debe ser 15");
            } else if (empty($request->getBody()['telefono'])) {
                $usuario->addError("telefono", "El campo telefono es requerido");
            } else if (strlen($request->getBody()['telefono']) < 10) {
                $usuario->addError("telefono", "La longitud mínima del telefono debe ser 10");
            } else if (strlen($request->getBody()['telefono']) > 14) {
                $usuario->addError("telefono", "La longitud máxima del telefono no puede ser mayor a 14");
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

    //direccion
    public function actualizar_direccion(Request $request)
    {
        usuarios::validarLogin();
        $usuario = new cuentaModel();
        $usuario->loadData($request->getBody());
        if (!empty($request->getBody()['direccion'])) {
            $direccion = $request->getBody()['direccion'];
            $fecha = Carbon::now();
            $email = $_SESSION['user_email'];
            $usuario = cuentaModel::actualizar_direccion($direccion, $fecha, $email);
            if ($usuario) {
                $direccion = cuentaModel::obtener_direccion($email);
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'La direccion se actualizó correctamente',
                    'direccion' => $direccion,
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La direccion no se pudo actualizar',
                    'code' => 422
                ];
            }
            return json_encode($data);
        } else {
            if (empty($request->getBody()['direccion'])) {
                $usuario->addError("direccion", "El campo direccion es requerido");
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

    //contraseña
    public function actualizar_contrasena(Request $request)
    {
        try {
            $usuario = new cuentaModel();
            $usuario->loadData($request->getBody());    
            $clave = $request->getBody()['password'];    
            if (!empty($clave) && strlen($clave) >= 6 && strlen($clave) <= 16) {
                $email = $_SESSION['user_email'];
                $claveActual = $usuario::obtener_clave_actual($email);
                if (password_verify($request->getBody()['passwordCurrent'], $claveActual) && !empty($request->getBody()['passwordCurrent'])) {                 
                    $ConfirmarClave = $request->getBody()['passwordConfirm'];
                    if ($clave == $ConfirmarClave && strlen($clave) == strlen($ConfirmarClave)) {
                        $nuevaClave = password_hash($request->getBody()['password'], PASSWORD_BCRYPT, ['cost' => 10]);
                        $update = $usuario::actualizarClave($email, $nuevaClave);
                        if ($update) {
                            $data = [
                                'title' => 'Contraseña Actualizada',
                                'messages' => 'Su contraseña se cambió exitosamente',
                                'code' => 200,
                                'route' => '/'
                            ];
                        } else {
                            $data = [
                                'title' => 'Error',
                                'messages' => 'Algo salio mal intente más tarde',
                                'code' => 404,
                            ];
                        }
                        return json_encode($data);
                    } else {
                        if ($clave !== $ConfirmarClave) {
                            $usuario->addError("password", "La contraseña nueva debe ser igual a confirmar contraseña");
                            $usuario->addError("password", "La longitud mínima debe ser 6");
                            $usuario->addError("password", "La longitud maxima debe ser 16");
                        }
                        $data = [
                            'title' => 'Las contraseñas no coinciden',
                            'messages' => $usuario->errors,
                            'code' => 422
                        ];
                        return json_encode($data);
                    }
                } else {
                    if (empty($request->getBody()['passwordCurrent'])) {
                        $usuario->addError("passwordCurrent", "El campo contraseña actual es requerido");
                    }
                    if (!password_verify($request->getBody()['passwordCurrent'], $claveActual)) {
                        $usuario->addError("passwordCurrent", "La contraseña actual es incorrecta");
                    }
                    $data = [
                        'title' => 'Error',
                        'messages' => $usuario->errors,
                        'code' => 422
                    ];
                    return json_encode($data);
                }
            } else {
                if (empty($clave) && strlen($clave) < 6 && strlen($clave) > 16) {
                    $usuario->addError("password", "El campo contraseña nueva es requerido");
                    $usuario->addError("password", "La longitud mínima debe ser 6");
                    $usuario->addError("password", "La longitud maxima debe ser 16");
                } else if (empty($clave)) {
                    $usuario->addError("password", "El campo contraseña nueva es requerido");
                } else if (strlen($clave) < 6 ) {
                    $usuario->addError("password", "La longitud mínima debe ser 6");
                } else if (strlen($clave) > 16) {
                    $usuario->addError("password", "La longitud maxima debe ser 16");
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