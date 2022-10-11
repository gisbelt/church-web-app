<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\actividadesCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\usuariosModel as usuarios;
use content\models\actividadesModel as actividades;
use content\models\miembrosModel as miembros;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class actividadController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['edit']));
        $this->registerMiddleware(new AutenticacionMiddleware(['store']));
        $this->registerMiddleware(new AutenticacionMiddleware(['update']));
        //$this->registerMiddleware(new AutenticacionMiddleware(['obtenerActividades']));
        //$this->registerMiddleware(new AutenticacionMiddleware(['obtenerTiposActividad']));
        //$this->registerMiddleware(new AutenticacionMiddleware(['obtenerMiembros']));
    }

    public function index()
    {
        if (!in_array(permisos::$lista_actividades, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        return $this->render('actividades/consultarView');
    }

    public function create()
    {
        if (!in_array(permisos::$crear_actividades, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Lista de actividades', 'Index actividades');
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Actividades';
        return $this->render('actividades/registrarView');
    }

    public function edit(Request $request)
    {
        if (!in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Editar de actividades', 'Editar actividades');
        try{
            $edit = $request->getRouteParams();
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, ['request' => $edit]);
            $user = usuarios::validarLogin();
            $data['titulo'] = 'Actualizar Actividades';

            return $this->render('actividades/editarView',[
            ]);
        }catch(\Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
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
                $miembro = $request->getBody()['miembro_id'];
                $fecha = Carbon::now();
                $actividades = actividades::registrarActividades($nombre, $description, $status, $tipo, $fecha);
                $horarios = actividades::horariosCreate($hora, $fechaHora, $fecha);
                $actividadHorarios = actividades::actividadesHorariosCreate($actividades['id'], $horarios['id'], $fecha);
                actividades::observacionActividad($actividades['id'], $observacion, $fecha);
                actividades::miembroActividad($miembro,$actividades['id'],$status,$fecha);
                bitacoraModel::guardar('Registro de actividades', 'Registro actividades');
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

    public function update(Request $request)
    {
        try{
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
                $actividades = actividades::registrarActividades($nombre,$description,$status,$tipo,$fecha);
                $horarios = actividades::horariosCreate($hora,$fechaHora,$fecha);
                $actividadHorarios = actividades::actividadesHorariosCreate($actividades['id'],$horarios['id'],$fecha);
                actividades::observacionActividad($actividades['id'],$observacion,$fecha);
                actividades::miembroActividad($actividades['id'],$observacion,$status,$fecha);
                if ($actividades && $horarios && $actividadHorarios) {
                    bitacoraModel::guardar('Actualizo de actividades'. $actividades['id'], 'Actualizo actividades');
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
        }catch (\Exception $ex){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex,'request'=> $request]);
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
    try{
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
        return json_encode($data);
    }catch(\Exception $exception){
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$exception]);
        return  json_encode([]);
    }

    }

    public function obtenerTiposActividad()
    {
        try {
            $tipo = actividades::tipoActividad();
            if(!is_null($tipo)){
                return  json_encode($tipo);
            }else{
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$tipo]);
                return json_encode([]);
            }

        }catch (\Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return  json_encode([]);
        }
    }

    public function obtenerMiembros()
    {
        try {
            $miembros = miembros::miemrbosSelect();
            if(!is_null($miembros)){
                return  json_encode($miembros);
            }else{
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$miembros]);
                return json_encode([]);
            }

        }catch (\Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return  json_encode([]);
        }
    }

}