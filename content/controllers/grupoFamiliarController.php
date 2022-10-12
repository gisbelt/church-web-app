<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\exception\ForbiddenException;
use content\core\Request;
use content\enums\permisos;
use content\collections\grupoFamiliarCollection;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\bitacoraModel;
use content\models\usuariosModel as usuarios;
use content\models\grupoFamiliarModel;
use content\models\miembrosModel as miembros;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerAmigos']));
        $this->registerMiddleware(new AutenticacionMiddleware(['buscarAmigo']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerGrupos']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerIntegrantesGrupo']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['eliminar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['asignarAmigos']));
        $this->registerMiddleware(new AutenticacionMiddleware(['asignarAmigos']));
    }

    //Mostra vista de lista
    public function index()
    {
        if (!in_array(permisos::$lista_grupo_familiar, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso en lista grupo familiar', 'Index grupo familiar');
        $user = usuarios::validarLogin();
        return $this->render('grupoFamiliar/consultarView');
    }

    //Mostra vista de crear
    public function create()
    {
        if (!in_array(permisos::$crear_grupo_familiar, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso en crear grupo familiar', 'Crear grupo familiar');
        $user = usuarios::validarLogin();        
        $lider = grupoFamiliarModel::lider();
        $zonas = grupoFamiliarModel::zonas();
        return $this->render('grupoFamiliar/registrarView', [
            'zonas' => $zonas,
            'lideres' => $lider,
        ]);
    }

    //Buscar amigo que no tenga grupo familiar (Lista)
    public function obtenerAmigos(Request $request){
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $amigos = grupoFamiliarModel::obtenerAmigo();
        if($amigos){
            $grupoFamiliarCollection = new grupoFamiliarCollection();
            $amigosFormat = $grupoFamiliarCollection->formatAmigosLista($amigos);
        } else {
            $amigosFormat = [];
        }
        $data = [
            'amigos' => $amigosFormat,
        ];
        return json_encode($data);
    }

    //Buscar amigo que no tenga grupo familiar (autocompletado)
    public function buscarAmigo(Request $request){
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $consultarAmigo = new grupoFamiliarModel();
        $consultarAmigo->loadData($request->getBody());
        $nombreAmigo = $request->getBody()['nombreAmigo'];
        $consultarAmigo = grupoFamiliarModel::buscarAmigo($nombreAmigo);
    }

    //Obtener Grupos
    public function obtenerGrupos(Request $request){
        $user = usuarios::validarLogin();
        $grupos = grupoFamiliarModel::obtenerGrupos();     
        if($grupos){
            $grupoFamiliarCollection = new grupoFamiliarCollection();
            $gruposFormat = $grupoFamiliarCollection->formatGrupos($grupos);
        } else {
            $gruposFormat = [];
        }
        $data = [
            'grupos' => $gruposFormat,
        ];

        return json_encode($data);
    }

    //Obtener Integrantes Grupos
    public function obtenerIntegrantesGrupo(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $integrantes = new grupoFamiliarModel();
        $integrantes->loadData($request->getBody());
        $grupo_id = $request->getBody()['grupo_id'];
        $integrantes = grupoFamiliarModel::obtenerIntegrantesGrupo($grupo_id);
        if($integrantes){
            $grupoFamiliarCollection = new grupoFamiliarCollection();
            $observarAmigosFormat = $grupoFamiliarCollection->formatObservarAmigos($integrantes);
        } else {
            $observarAmigosFormat = [];
        }   
        $data = [
            'amigos' => $observarAmigosFormat,
        ];

        return json_encode($data);
    }

    //Registrar grupo y amigo a grupo familiar
    public static function guardar(Request $request){
        $user = usuarios::validarLogin();
        $gf = new grupoFamiliarModel();
        $gf->loadData($request->getBody());
        $nombre = $request->getBody()['nombre'];
        $direccion = $request->getBody()['direccion'];
        $lider = $request->getBody()['lider'];
        $zona = $request->getBody()['zona'];
        $fecha_crear = Carbon::now();
        $amigo_id = $request->getBody()['amigo_id'];
        if(isset($nombre)){
            if($gf->validate()){
                $gf = grupoFamiliarModel::guardar($nombre,$direccion,$lider,$zona,$fecha_crear,$amigo_id);     
                bitacoraModel::guardar('Creo el grupo familiar:'. $nombre, 'Creo grupo familiar');
            }
            if(count($gf->errors) > 0){
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => $gf->errors,
                    'code' => 422
                ];
                return json_encode($data, 422);
            } 
        }        
        $gf = grupoFamiliarModel::guardar($nombre,$direccion,$lider,$zona,$fecha_crear,$amigo_id);     
        bitacoraModel::guardar('Creo el grupo familiar:'. $nombre, 'Creo grupo familiar');
    }

    // Editar View 
    public function editar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }        
        $id = $request->getRouteParams();
        $grupo = grupoFamiliarModel::id_grupo($id['id']);
        $lider = grupoFamiliarModel::lider();
        $zonas = grupoFamiliarModel::zonas();
        bitacoraModel::guardar('Ingreso en editar grupo familiar: '. $grupo['nombre'], 'Editar grupo familiar');
        return $this->render('grupoFamiliar/editarView', [
            'zonas' => $zonas,
            'lideres' => $lider,
            'grupo' => $grupo['grupo'],
            'nombre' => $grupo['nombre'],
            'direccion' => $grupo['direccion'],
            'lider' => $grupo['lider'],
            'lider_id' => $grupo['lider_id'],
            'zona' => $grupo['zona'],
            'zona_id' => $grupo['zona_id'],
        ]);
    }

    // Actualizar grupo
    public function actualizar(Request $request)
    {
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $grupo = new grupoFamiliarModel();
        $grupo->loadData($request->getBody());
        if ($grupo->validate()) {
            $grupo_id = $request->getBody()['grupo_id'];
            $nombre = $request->getBody()['nombre'];
            $direccion = $request->getBody()['direccion'];
            $lider = $request->getBody()['lider'];
            $zona = $request->getBody()['zona'];
            $fecha_actualizado = Carbon::now();
            $grupo = grupoFamiliarModel::actualizar($nombre, $direccion, $lider, $zona, $fecha_actualizado, $grupo_id);
            if ($grupo) {
                bitacoraModel::guardar('Edito el grupo familiar:'. $nombre, 'Edito grupo familiar');
                $data = [
                    'title' => 'Datos actualizados',
                    'messages' => 'El Grupo Familiar se ha actualizado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El Grupo Familiar no se ha actualizado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        if (count($grupo->errors) > 0) {
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $grupo->errors,
                'code' => 422
            ];
            return json_encode($data, 422);
        }
    }

    // Eliminar Grupo 
    public function eliminar(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $grupo_id = $request->getRouteParam('id');
        if(!is_null($grupo_id)){
            $grupos = grupoFamiliarModel::eliminar($grupo_id);
            if($grupos){
                bitacoraModel::guardar('Elimino el grupo familiar:'. $grupo_id, 'Elimino grupo familiar');
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'Grupo Familiar se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'Grupo Familiar no se ha eliminado',
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

    //Asignar Amigo
    public static function asignarAmigos(Request $request){
        $user = usuarios::validarLogin();
        $gf = new grupoFamiliarModel();
        $gf->loadData($request->getBody());
        $grupo_id = $request->getBody()['grupo_id'];
        $amigo_id = $request->getBody()['amigo_id'];
        $gf = grupoFamiliarModel::asignarAmigos($grupo_id,$amigo_id);
        if ($gf) {
            bitacoraModel::guardar('Agrego el amigo '. $amigo_id. ' al grupo familiar:'. $grupo_id, 'Agrego amigo al grupo familiar');
            $data = [
                'title' => 'Datos registrados',
                'messages' => 'Se agregó el amigo',
                'code' => 200
            ];
        } else {
            $data = [
                'title' => 'Error',
                'messages' => 'No se pudo agregar el amigo',
                'code' => 422
            ];
        }
        return json_encode($data);     
    }

    // Eliminar Amigo 
    public function eliminarAmigo(Request $request)
    {
        $user = usuarios::validarLogin();
        $amigo_id = $request->getRouteParam('id');
        $grupo_id = $request->getRouteParam('grupo_id');
        if(!is_null($amigo_id)){
            $amigos = grupoFamiliarModel::eliminarAmigo($amigo_id,$grupo_id);
            if($amigos){
                bitacoraModel::guardar('Elimino el amigo: '. $amigo_id. ' del grupo familiar:'. $grupo_id, 'Agrego amigo al grupo familiar');
                $data = [
                    'title' => 'Dato eliminado',
                    'messages' => 'El amigo se ha eliminado',
                    'code' => 200
                ];
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El amigo no se ha eliminado',
                    'code' => 422
                ];
            }
            return json_encode($data);
        }
        $data = [
            'title' => 'Error',
            'messages' => 'Algo salio mal intente mas tarde',
            'code' => 422
        ];
        return json_encode($data, 422);
    }
}