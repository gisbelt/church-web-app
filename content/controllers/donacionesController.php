<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\donacionesCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\donacionesModel as donacion;
use content\models\miembrosModel as miembros;
use content\models\notificacionModel;
use content\models\observacionDonacionModel;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class donacionesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerDonaciones']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardarObservacionDonacion']));
    }

    // Actualizar donacion
    public function actualizar(Request $request)
    {
        usuarios::validarLogin();
        $donacion = new donacion();
        $donacion->loadData($request->getBody());
        if ($donacion->validate()) {
            $detalles = $request->getBody()['detalles'];
            $donacion = $request->getBody()['donacion'];
            $cantidad = $request->getBody()['cantidad'];
            $fecha_actualizado = Carbon::now();
            $donacion = donacion::actualizar_donacion($detalles, $cantidad, $donacion, $fecha_actualizado);
            if ($donacion) {
                bitacoraModel::guardar('Actualizo donacion:'. $donacion, 'Actualizar donacion');
                $data = [
                    'title' => 'Datos actualizado',
                    'messages' => 'Donacion actualizada',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La donacion no se ha actualizado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        if (count($donacion->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $donacion->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    public function index()
    {
        if (!in_array(permisos::$lista_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso lista donacion', 'Index donacion');
        $user = usuarios::validarLogin();
        return $this->render('donaciones/consultarView');
    }

    // Vista crear donacion
    public function create()
    {
        if (!in_array(permisos::$crear_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        bitacoraModel::guardar('Ingreso crear donacion', 'Crear donacion');
        $tipoDonacion = donacion::tipo_donaciones();
        $miembros = miembros::obtener_miembros();
        return $this->render('donaciones/registrarView', [
            'tipo_donaciones' => $tipoDonacion,
            'miembros' => $miembros
        ]);
    }

    // Guardar donacion
    public function guardar(Request $request)
    {
        if (!in_array(permisos::$crear_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        try {
            usuarios::validarLogin();
            $donacion = new donacion();
            $donacion->loadData($request->getBody());
            if ($donacion->validate()) {
                $donante = $request->getBody()['donante'];
                $detalles = $request->getBody()['detalles'];
                $tipo_donacion = $request->getBody()['tipo_donacion'];
                $cantidad = $request->getBody()['cantidad'];
                $fecha_crear = Carbon::now();
                $donacion = donacion::guardar($donante, $detalles, $tipo_donacion, $cantidad, $fecha_crear);
                if ($donacion) {
                    bitacoraModel::guardar('Registro donacion:'. $detalles, 'Registro donacion');
                    notificacionModel::agregar_mensaje($detalles, $fecha_crear, $_SESSION['user']);
                    $data = [
                        'title' => 'Datos registrado',
                        'messages' => 'La donacion se ha registrado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'La donacion no se ha registrado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            }
            if (count($donacion->errors) > 0) {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => $donacion->errors,
                    'code' => 422
                ];
                return json_encode($data, 422);
            }
        } catch (\Exception $exception) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
        }

    }

    // Obtener donaciones
    public function obtenerDonaciones()
    {
        $user = usuarios::validarLogin();
        $donaciones = donacion::obtener_donaciones();

        if ($donaciones) {
            $donacionesCollection = new donacionesCollection();
            $donacionesFormat = $donacionesCollection->formatDonaciones($donaciones);
        } else {
            $permisosFormat = [];
        }
        $data = [
            'donaciones' => $donacionesFormat,
        ];
        return json_encode($data);
    }

    // Obtener donaciones por id
    public function editar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$actualizar_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParams();
        $donacion = donacion::id_donacion($id['id']);
        $tipoDonacion = donacion::tipo_donaciones();
        $miembros = miembros::obtener_miembros();
        bitacoraModel::guardar('Ingreso en editar donacion: '.$donacion['donacion'], 'Editar donacion');
        return $this->render('donaciones/editarView', [
            'donacion' => $donacion['donacion'],
            'detalle' => $donacion['detalles'],
            'cantidad' => $donacion['cantidad'],
            'donante' => $donacion['donante_id'],
            'tipo' => $donacion['tipo_donacion_id'],
            'tipo_donaciones' => $tipoDonacion,
            'miembros' => $miembros
        ]);
    }

    // Eliminar donacion
    public function eliminar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$eliminar_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if (!is_null($id)) {
            $donacion = donacion::eliminar($id);
            if ($donacion) {
                bitacoraModel::guardar('Elimino donacion:'. $id['id'], 'Eliminar donacion');
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'Donacion se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La donacion no se ha eliminado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        $data = [
            'title' => 'Error',
            'messages' => 'Algo salio mal intente mas tardes',
            'code' => 422
        ];
        return json_encode($data, 422);
    }

    //guardar obersvaciones
    public function guardarObservacionDonacion(Request $request)
    {
        if (!in_array(permisos::$obseravacion_donacion, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $observacionDonacion = new observacionDonacionModel();
        $observacionDonacion->loadData($request->getBody());
        if ($observacionDonacion->validate()) {
            $cantidad = $request->getBody()['cantidad'];
            $descripcion = $request->getBody()['descripcion'];
            $donacion_id = $request->getBody()['donacion_id'];
            $fecha = Carbon::now();
            $observacion_donacion = observacionDonacionModel::guardar($cantidad, $descripcion, $donacion_id, $fecha);
            if ($observacion_donacion) {
                bitacoraModel::guardar('Observacion donacion:'. $donacion_id, 'Agrego donacion');
                $data = [
                    'title' => 'Datos registrado',
                    'messages' => 'Observacion de la donacion registrada',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La observacion no se ha registrado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        if (count($observacionDonacion->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $observacionDonacion->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

}