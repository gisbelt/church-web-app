<?php

namespace content\controllers;

use content\collections\notificacionCollection;
use content\models\bitacoraModel;
use Carbon\Carbon;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\notificacionModel;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class notificacionController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['crear']));
    }

    public function index()
    {
        if (!in_array(permisos::$notificacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso al notificacion', 'Index notificacion');
        usuarios::validarLogin();
        return $this->render('notificaciones/consultarView',[]);
    }

    public function crear(Request $request)
    {
        if (!in_array(permisos::$notificacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        try {
            usuarios::validarLogin();
            if ($request->isPost()) {
                $notificacion = new notificacionModel();
                $notificacion->loadData($request->getBody());

                if($request->getBody()['mesanje'] != ''){
                    $fecha =  Carbon::now();
                    $mensaje = $request->getBody()['mesanje'];
                    $seguridad = notificacionModel::agregar_mensaje($mensaje, $fecha, $_SESSION['user']);
                    if($seguridad){
                        bitacoraModel::guardar('Registro de notificacion: '. $mensaje, 'Crear notificaicon');
                        $data = [
                            'title' => 'Datos registrado',
                            'messages' => 'la notificacion se ha registrado',
                            'code' => 200
                        ];
                    } else {
                        $data = [
                            'title' => 'Error',
                            'messages' => 'La notificacion no se ha registrado',
                            'code' => 422
                        ];
                    }
                    return json_encode($data);
                } else {
                    $data = [
                        'title' => 'Datos invalidos',
                        'messages' => 'Debe agregar un mensaje',
                        'code' => 422
                    ];
                    return json_encode($data, 422);
                }
            }
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }

    public function navbar()
    {
        try {
            $notificaciones = notificacionModel::obtener_notificacion();
            if($notificaciones){
                $notificacionCollection = new notificacionCollection();
                $notificacionFormat = $notificacionCollection->formatNotificacion($notificaciones);
            } else {
                $notificacionFormat = [
                    'notificaciones' => [],
                    'cantidad' => 0
                ];
            }
            $data = [
                'notificaciones' => $notificacionFormat['notificaciones'],
                'cantidad' => $notificacionFormat['cantidad'],
            ];
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }

    public function leida(Request $request)
    {
        try {
            $id = $request->getRouteParams();
            $fecha =  Carbon::now();
            $notificaciones = notificacionModel::leida($id['id'], $fecha);
            $data = [
                'status' => 'ok'
            ];
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }
}