<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\asistenciasModel;
use content\models\usuariosModel as usuarios;
use content\models\actividadesModel;
use content\collections\asistenciasCollection;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class asistenciasController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerAsistencias']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminar']));
    }

    public function index()
    {
        if (!in_array(permisos::$lista_asitencias, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();        
        return $this->render('asistencias/consultarView');
    }

    public function create()
    {
        if (!in_array(permisos::$crear_asitencias, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();        
        $actividades = actividadesModel::cargarActividades();
        return $this->render('asistencias/registrarView', [
            'actividades' => $actividades,
        ]);
    }

    //Registrar asistencia
    public static function guardar(Request $request){
        $user = usuarios::validarLogin();
        $asistencias = new asistenciasModel();
        $asistencias->loadData($request->getBody());        
        if($asistencias->validate()){ 
            $asistenciasData = asistenciasModel::obtener_asistencias_actividad($request->getBody()['actividad']);
            if(!$asistenciasData){
                $actividad = $request->getBody()['actividad'];
                $detalles = $request->getBody()['detalles'];
                $fecha = Carbon::now();           
                $asistencias = asistenciasModel::guardar($actividad,$detalles,$fecha);
                if ($asistencias) {
                    $data = [
                        'title' => 'Datos actualizados',
                        'messages' => 'La asistencia se ha registrado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'La asistencia no se ha registrado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
            } else {
                $data = [
                    'title' => '<a href="/asistencias" class="text-decoration-underline">Ver listado de asistencias</a>',
                    'messages' => 'Ya existe una asistencia para esta actividad',
                    'code' => 200
                ];
                return json_encode($data, 200);
            }
        }
        if (count($asistencias->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $asistencias->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    //Obtener asistencias
    public function obtenerAsistencias(Request $request){
        $user = usuarios::validarLogin();
        $asistencias = asistenciasModel::obtenerAsistencias();     
        if($asistencias){
            $asistenciasCollection = new asistenciasCollection();
            $asistenciasFormat = $asistenciasCollection->formatAsistencias($asistencias);
        } else {
            $asistenciasFormat = [];
        }
        $data = [
            'asistencias' => $asistenciasFormat,
        ];

        return json_encode($data);
    }

    // Obtener asistencias por id
    public function editar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$actualizar_asitencias, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParams();
        $asistencias = asistenciasModel::id_asistencias($id['id']);
        $actividades = actividadesModel::cargarActividades();
        return $this->render('asistencias/editarView', [
            'actividad_id' => $asistencias['actividad_id'],
            'nombre' => $asistencias['nombre'],
            'detalles' => $asistencias['detalles'],
            'asistencia' => $asistencias['asistencia'],
            'actividades' => $actividades,
        ]);
    }

    // Actualizar asistencia
    public function actualizar(Request $request)
    {
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $asistencias = new asistenciasModel();
        $asistencias->loadData($request->getBody());
        if ($asistencias->validate()) {
            $asistencia = $request->getBody()['asistencia'];
            $actividad_id = $request->getBody()['actividad'];
            $detalles = $request->getBody()['detalles'];
            $fecha_actualizado = Carbon::now();
            $asistencias = asistenciasModel::actualizar_asistencia($actividad_id, $detalles, $fecha_actualizado, $asistencia);
            if ($asistencias) {
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'Asistencia actualizada',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La Asistencia no se ha actualizado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        if (count($asistencias->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $asistencias->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    // Eliminar asistencia
    public function eliminar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $asistencias = asistenciasModel::eliminar($id);
            if($asistencias){
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'La asistencia se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'La asistencia no se ha eliminado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        $data = [
            'title' => 'Error',
            'messages' => 'Algo salio mal, intente más tarde',
            'code' => 422
        ];
        return json_encode($data, 422);
    }


}