<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\seguridadCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\seguridadModel;
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

    public function index()
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        return $this->render('seguridad/consultarView');
    }

    public function obtenerPermisos()
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $permisos = seguridadModel::obtener_permisos();

        if($permisos){
            $seguridaCollection = new seguridadCollection();
            $permisosFormat = $seguridaCollection->formatPermisos($permisos);
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
        return $this->render('seguridad/registrarView');
    }

    public function guardar(Request $request)
    {
        $user = usuarios::validarLogin();
        if ($request->isPost()) {
            $seguridad = new seguridadModel();
            $seguridad->loadData($request->getBody());
            $nombre = $request->getBody()['nombre'];

            if($seguridad->validate()){
                $fecha =  Carbon::now();
                $seguridad = seguridadModel::agregar_permiso($nombre, $fecha);
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
}