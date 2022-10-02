<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\exception\ForbiddenException;
use content\core\Request;
use content\enums\permisos;
use content\models\usuariosModel as usuarios;
use content\models\cuentaModel as cuenta;
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
        $usuario = cuenta::obtener_usuario_correo($email);
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

}

?>