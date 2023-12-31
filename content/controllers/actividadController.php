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
use content\models\notificacionModel;
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
        $this->registerMiddleware(new AutenticacionMiddleware(['createTipo']));
        $this->registerMiddleware(new AutenticacionMiddleware(['edit']));
        $this->registerMiddleware(new AutenticacionMiddleware(['store']));
        $this->registerMiddleware(new AutenticacionMiddleware(['storeTipo']));
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

    public function createTipo()
    {
        if (!in_array(permisos::$crear_actividades, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Lista de actividades', 'Index actividades');
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Tipo de Actividades';
        return $this->render('actividades/tipo/registrarView');
    }

    /**
     * View Edit
     *
     * @param Request $request
     *
     * @return array|false|string|string[]|void
     */
    public function edit(Request $request)
    {
        if (!in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Editar de actividades', 'Editar actividades');
        try {
            $edit = $request->getRouteParams();
            $actividades = actividades::actividadesPorId($edit['id']);
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, ['cargar' => $actividades]);
            $user = usuarios::validarLogin();
            $fecha = $actividades['fecha'];
            $hora = $actividades['hora'];
            $tipo = $actividades['tipo'];
            $fecha = date("d-m-Y", strtotime($fecha));

            $hora = date("h:i:s", strtotime($hora));
            switch ($actividades['estado_id']) {

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
                default:
                {
                    $status = 'No Disponible';
                }
            }
            $dataStatus = [
                [
                    'id' => 1,
                    'nombre' => 'En Curso',
                ],
                [
                    'id' => 2,
                    'nombre' => 'Terminado'
                ],

                [
                    'id' => 3,
                    'nombre' => 'En Pausa'
                ],
                [
                    'id' => 4,
                    'nombre' => 'Cancelado'
                ]


            ];
            $data['titulo'] = 'Actualizar Actividades';
            return $this->render('actividades/editarView', [
                'id' => $edit['id'],
                'nombre' => $actividades['actividad'],
                'descripcion' => $actividades['descripcion'],
                'observacion' => $actividades['observacion'],
                'fecha' => $fecha,
                'hora' => $hora,
                'tipo' => $tipo,
                'id_tipo' => $actividades['id_tipo'],
                'estado_id' => $actividades['estado_id'],
                'estado' => $status,
                'select_estado' => $dataStatus
            ]);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }
    }

    public function store(Request $request)
    {
        try {
            if (!in_array(permisos::$actividades, $_SESSION['user_permisos'])) {
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
                $fechaHora = !empty($request->getBody()['fecha']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha'])->format('Y-m-d') : null;
                $hora = $request->getBody()['hora'];
                $observacion = $request->getBody()['observacion'];
                $miembro = $request->getBody()['miembro_id'];
                $fecha = Carbon::now();
                $actividades = actividades::registrarActividades($nombre, $description, $status, $tipo, $fecha);
                $horarios = actividades::horariosCreate($hora, $fechaHora, $fecha);
                $actividadHorarios = actividades::actividadesHorariosCreate($actividades['id'], $horarios['id'], $fecha);
                actividades::observacionActividad($actividades['id'], $observacion, $fecha);
                actividades::miembroActividad($miembro, $actividades['id'], $status, $fecha);
                // notificacion 
                notificacionModel::agregar_mensaje($nombre, $fechaHora, $_SESSION['user']);
                bitacoraModel::guardar('Registro de actividades', 'Registro actividades');
                bitacoraModel::guardar('Registro de notificacion: '. $nombre, 'Crear notificacion');
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

    public function storeTipo(Request $request)
    {
        try {
            if (!in_array(permisos::$actividades, $_SESSION['user_permisos'])) {
                throw new ForbiddenException();
            }
//            usuarios::validarLogin();
            $actividad = new actividades();
            $actividad->loadData($request->getBody());
            if ($actividad->validate()) {
                $tipo = $request->getBody()['nombre'];
                $fecha = Carbon::now();
                $actividades = actividades::registrarTipoActividades($tipo, $fecha);
                bitacoraModel::guardar('Registro de tipo de actividades', 'Registro tipo de actividades');
                if ($actividades) {
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'Tipo de actividad se ha registrado',
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
        try {
            $logger = new Logger("actu");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, ['request' => $request]);
            if (!in_array(permisos::$actividades, $_SESSION['user_permisos'])) {
                throw new ForbiddenException();
            }
            usuarios::validarLogin();
            $logger = new Logger("update");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, ['request' => $request->getBody()]);
            $actividad = new actividades();
            $actividad->loadData($request->getBody());
            if ($actividad->validate()) {
                $nombre = $request->getBody()['nombre'];
                $miembro = $request->getBody()['miembro_id'];
                $id = $request->getBody()['id'];
                $description = $request->getBody()['descripcion'];
                $tipo = $request->getBody()['tipo_actividad'];
                $status = $request->getBody()['status'];
                $fechaHora = $request->getBody()['fecha'];
                $hora = $request->getBody()['hora'];
                $observacion = $request->getBody()['observacion'];
                $fecha = Carbon::now();
                $actividades = actividades::modificarActividades($nombre, $description, $status, $tipo, $fecha, $id);
                $actividadHorarios = actividades::horarioActividadModificacion($hora, $fechaHora, $id);  
                actividades::miembroActividadModificacion($miembro, $id, $status, $fecha);
                actividades::observacionActividadModificar($id, $observacion, $fecha);                              

                if ($actividades && $actividadHorarios) {
                    bitacoraModel::guardar('Actualizo la actividad: ' . $nombre, 'Actualizo actividades');
                    notificacionModel::agregar_mensaje($nombre, $fecha, $_SESSION['user']);
                    $data = [
                        'title' => 'Datos Actualizados',
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
                return json_encode($data, 200);
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
            $actividades = actividades::cargarActividades();
            if ($actividades) {
                $actividadesCollection = new actividadesCollection();
                $permisosFormat = $actividadesCollection->formatActividadesData($actividades);
            } else {
                $permisosFormat = [];
            }
            $data = [
                'actividades' => $permisosFormat,
            ];
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }
    }

    public function obtenerActividadesCalendario()
    {
        try {
            $user = usuarios::validarLogin();
            $actividades = actividades::cargarActividades();
            $data = array();
            foreach ($actividades as $actividad) {
                switch ($actividad['status']) {
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
                    default:
                    {
                        $status = 'No Disponible';
                    }
                }
                $event = array(
                    'id' => $actividad['id'],
                    'title' => $actividad['nombre'],
                    'start' => date('Y-m-d\TH:i:s', strtotime($actividad['fecha'] . ' ' . $actividad['hora'])),// fecha y hora de inicio
                    'description' => $actividad['descripcion'], // descripción del evento (opcional)
                    'status' => $status
                    // otras propiedades opcionales...
                );
                array_push($data, $event);
            }
            return json_encode($data);
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }
    }

    public function obtenerTiposActividad()
    {
        try {
            $tipo = actividades::tipoActividad();
            if (!is_null($tipo)) {
                return json_encode($tipo);
            } else {
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$tipo]);
                return json_encode([]);
            }

        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }
    }

    public function obtenerMiembros()
    {
        try {
            $miembros = miembros::miemrbosSelect();
            if (!is_null($miembros)) {
                return json_encode($miembros);
            } else {
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$miembros]);
                return json_encode([]);
            }

        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return json_encode([]);
        }
    }

}