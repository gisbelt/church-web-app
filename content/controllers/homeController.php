<?php

namespace content\controllers;

use content\core\Aplicacion;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\homeModel;
use content\models\usuariosModel as usuarios;
use DateTime;
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
        $amigos = homeModel::countAmigos();
        $miembrosAct = homeModel::countMiembrosActivos();
        $miembrosPas = homeModel::countMiembrosPasivos();
        $donaciones = homeModel::countDonaciones();
        $user = usuarios::validarLogin();
        return $this->render('homeView',[
            'amigos' => $amigos['numrows'],
            'miembrosAct' => $miembrosAct['numrows'],
            'miembrosPas' => $miembrosPas['numrows'],
            'donaciones' => $donaciones['numrows'],
        ]);
    }

    public function formatActividades($actividades)
    {
        $data = [];
        foreach ($actividades as $actividad) {
            $date = $actividad['fecha'] . ' ' . $actividad['hora'];
            $date = new DateTime($date);
            $actividad['fecha'] = $date->format('d/m/Y H:i:s');
            $data[] = $actividad;
        }
        return $data;
    }
    public function proximasActividades()
    {
        try{
            $user = usuarios::validarLogin();            
            $actividades = homeModel::cargarActividades();            
            if ($actividades) {
                $actividadesFormat =  $this->formatActividades($actividades);            
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

    public function formatBitacora($bitacoras)
    {
        $data = [];
        foreach ($bitacoras as $bitacora) {
            $date = $bitacora['fecha'];
            $date = new DateTime($date);
            $bitacora['fecha'] = $date->format('d/m/Y H:i:s');
            $data[] = $bitacora;
        }
        return $data;
    }
    public function bitacoraLastActions()
    {
        try{
            $user = usuarios::validarLogin();            
            $bitacoras = homeModel::bitacoraLastActions(); 
            if ($bitacoras) {
                $bitacoraFormat =  $this->formatBitacora($bitacoras);            
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