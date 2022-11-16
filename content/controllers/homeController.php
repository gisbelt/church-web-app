<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\homeCollection;
use content\core\Aplicacion;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\homeModel;
use content\models\notificacionModel;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class homeController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
    }

    public function index()
    {
        if (!in_array(permisos::$home, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso al home', 'Index home');
        $notificacioneCantidad = 0;
        $amigos = homeModel::countAmigos();
        $miembrosAct = homeModel::countMiembrosActivos();
        $miembrosPas = homeModel::countMiembrosPasivos();
        $donaciones = homeModel::countDonaciones();

        $user = usuarios::validarLogin();
        return $this->render('homeView',[
            'amigos' => $amigos['numrows'],
            'miembrosAct' => $miembrosAct['numrows'],
            'miembrosPas' => $miembrosPas['numrows'],
            'donaciones' => $donaciones['numrows']
        ]);
    }


    public function proximasActividades()
    {
        try{
            usuarios::validarLogin();
            $fecha = Carbon::now()->format('Y-m-d');
            $actividades = homeModel::cargarActividades($fecha);
            if ($actividades) {
                $homeCollection = new homeCollection();
                $actividadesFormat =  $homeCollection->formatActividades($actividades);
            } else {
                $actividadesFormat = [];
            }  
            $data = [
                'actividades' => $actividadesFormat,
            ];         
            return json_encode($data);
        }catch(\Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return  json_encode([]);
        }
    }

    public function bitacoraLastActions()
    {
        try{
            $user = usuarios::validarLogin();            
            $bitacoras = homeModel::bitacoraLastActions(); 
            if ($bitacoras) {
                $homeCollection = new homeCollection();
                $bitacoraFormat =  $homeCollection->formatBitacora($bitacoras);
            } else {
                $bitacoraFormat = [];
            }           
            $data = [
                'bitacora' => $bitacoraFormat,
            ];          
            return json_encode($data);
        }catch(\Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return  json_encode([]);
        }
    }


}

?>