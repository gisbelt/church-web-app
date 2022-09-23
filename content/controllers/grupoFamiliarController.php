<?php

namespace content\controllers;

use content\core\exception\ForbiddenException;
use content\core\Request;
use content\enums\permisos;
use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;
use content\models\grupoFamiliarModel;
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
        $data['titulo'] = 'Grupos Familiares';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/grupoFamiliar/consultarView.php')), 200);
        return $this->render('grupoFamiliar/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $consultarMiembroLista = grupoFamiliarModel::buscarMiembroLista();

        return $this->render('grupoFamiliar/registrarView', [
            'miembros_lista' => $consultarMiembroLista
        ]);
    }

    //Buscar miembro que no tenga grupo familiar (autocompletado)
    public function buscarMiembro(Request $request){
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$permiso, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $consultarMiembro = new grupoFamiliarModel();
        $consultarMiembro->loadData($request->getBody());
        $nombreMiembro = $request->getBody()['nombreMiembro'];
        $consultarMiembro = grupoFamiliarModel::buscarMiembro($nombreMiembro);
    }

    //Registrar miembro a grupo familiar
    public static function registrarGrupoFamiliar(Request $request){
        $user = usuarios::validarLogin();
        $gf = new grupoFamiliarModel();
        $gf->loadData($request->getBody());
        $nombreGrupoFamiliar = $request->getBody()['nombreGrupoFamiliar'];
        $miembroId = $request->getBody()['miembroId'];
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$request]);
        if(isset($nombreGrupoFamiliar)){
            if($gf->validate()){
                $gf = grupoFamiliarModel::registrarGrupoFamiliar($nombreGrupoFamiliar,$miembroId);     
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
        
        $gf = grupoFamiliarModel::registrarGrupoFamiliar($nombreGrupoFamiliar,$miembroId);     
    }
}

?>