<?php

namespace content\controllers;

use content\collections\actividadesCollection;
use content\collections\donacionesCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\donacionesModel as donacion;
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
        $data['titulo'] = 'Actividades';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/actividades/consultarView.php')), 200);
        return $this->render('actividades/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Actividades';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/actividades/registrarView.php')), 200);
        return $this->render('actividades/registrarView');
    }
    
    public function obtenerActividades(){
        
        $user = usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $actividades = actividades::cargarActividades();
    
        if($actividades){
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
    }

}