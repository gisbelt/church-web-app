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
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }        
        $email = $_SESSION['user_email'];
        $usuario = cuentaModel::obtener_usuario_correo($email);
        return $this->render('/perfil/cuenta/cuentaView', [
            'nombre_completo' => $usuario['nombre_completo'],
            'telefono' => $usuario['telefono'],
            'direccion' => $usuario['direccion'],
        ]);
    }
    
    public function preferencias()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Preferencias';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/perfil/preferencias/preferenciasView.php')), 200);
        return $this->render('/perfil/preferencias/preferenciasView');
    }

    public function actualizar_username(Request $request)
    {
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        usuarios::validarLogin();
        $usuario = new cuentaModel();
        $usuario->loadData($request->getBody());   
        if (!empty($request->getBody()['username'])) {    
            $username = $request->getBody()['username'];
            $email = $_SESSION['user_email'];
            $usuario = cuentaModel::actualizar_username($username,$email);            
            $logger->debug(__METHOD__, [$usuario]);
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
                    'messages' => 'El nombre de usuarui no se pudo actualizar',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }else {
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

}

?>