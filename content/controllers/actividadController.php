<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\actividadesCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\usuariosModel as usuarios;
use content\models\actividadesModel as actividades;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class actividadController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        return $this->render('actividades/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Actividades';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/actividades/registrarView.php')), 200);
        return $this->render('actividades/registrarView');
    }

    public function store(Request $request)
    {
        try {
            if (!in_array(permisos::$donaciones, $_SESSION['user_permisos'])) {
                throw new ForbiddenException();
            }
            usuarios::validarLogin();
            $actividad = new actividades();
            $actividad->loadData($request->getBody());
            if ($actividad->validate()) {
                $nombre = $request->getBody()['nombre'];
                $description = $request->getBody()['descripcion'];
                $tipo = $request->getBody()['tipo_actividad'];
                $status = $request->getBody()['status'];
                $fechaHora = $request->getBody()['fecha'];
                $hora = $request->getBody()['hora'];
                $observacion = $request->getBody()['observacion'];
                $fecha = Carbon::now();
                $actividades = actividades::registrarActividades($nombre, $description, $status, $tipo, $fecha);
                $horarios = actividades::horariosCreate($hora, $fechaHora, $fecha);
                $actividadHorarios = actividades::actividadesHorariosCreate($actividades['id'], $horarios['id'], $fecha);
                actividades::observacionActividad($actividades['id'], $observacion, $fecha);
                if ($actividades && $horarios && $actividadHorarios) {
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'La actividad se ha registrado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'La actividad no se ha registrado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
            if (count($actividad->errors) > 0) {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => $actividad->errors,
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

    public function obtenerActividades()
    {
        try {
            $user = usuarios::validarLogin();
            if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
                throw new ForbiddenException();
            }
            $actividades = actividades::cargarActividades();

            if ($actividades) {
                $actividadesCollection = new actividadesCollection();
                $permisosFormat = $actividadesCollection->formatActividades($actividades);
            } else {
                $permisosFormat = [];
            }
            $data = [
                'actividades' => $permisosFormat,
            ];
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$data]);
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }

    }

}