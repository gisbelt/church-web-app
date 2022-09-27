<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\exception\ForbiddenException;
use content\core\Request;
use content\enums\permisos;
use content\collections\grupoFamiliarCollection;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
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
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        return $this->render('grupoFamiliar/consultarView');
    }

    public function create()
    {
        if (!in_array(permisos::$donaciones, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
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
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$request->getBody()]);
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
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        
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
    }

    // Eliminar Grupo 
    public function eliminarGrupo(Request $request)
    {
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $grupo_id = $request->getRouteParam('id');
        if(!is_null($grupo_id)){
            $grupos = grupoFamiliarModel::eliminarGrupo($grupo_id);
            if($grupos){
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
}