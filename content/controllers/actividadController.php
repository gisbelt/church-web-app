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
use content\models\miembrosModel as miembros;
use content\enums\estadosActividad as status;
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
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerActividades']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerTiposActividad']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerMiembros']));
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

    public function edit(Request $request)
    {
        try{
            $edit = $request->getRouteParams();
            $actividades = actividades::actividadesPorId($edit['id']);
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, ['cargar' => $actividades]);
            $user = usuarios::validarLogin();
            $fecha = $actividades['fecha'];
            $hora= $actividades['hora'];
            $tipo = $actividades['tipo'];
            $fecha = date("d-m-Y", strtotime($fecha));
            $hora = date("h:i:s A", strtotime($hora));
            switch ($actividades['estado_id']){
                case status::$en_curso:
                    $status = 'En Curso';
                    break;
                case status::$en_pausa:
                    $status = 'En Pausa';
                    break;
                case status::$terminado:
                    $status = 'Terminado';
                    break;
                case status::$cancelado:
                    $status = 'Cancelado';
                    break;
            }
            $data['titulo'] = 'Actualizar Actividades';
            return $this->render('actividades/editarView',[
                'nombre' => $actividades['actividad'],
                'descripcion' => $actividades['descripcion'],
                'observacion' => $actividades['observacion'],
                'fecha' => $fecha,
                'hora'=> $hora,
                'tipo' => $tipo,
                'id_tipo' => $actividades['id_tipo'],
                'estado_id' => $actividades['estado_id'],
                'estado' => $status
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
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'La actividad se ha actualizado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'La actividad no se ha actualizado',
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