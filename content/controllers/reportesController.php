<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\miembrosCollection;
use content\collections\grupoFamiliarCollection;
use content\core\Request;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\miembrosModel;
use content\models\grupoFamiliarModel;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class reportesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['dataDonacion']));
    }

    public function index()
    {
        if (!in_array(permisos::$reportes, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $user = usuarios::validarLogin();
        bitacoraModel::guardar('Ingreso a reportes', 'Index reportes');
        return $this->render('/reportes/reportesView');
    }

    public function dataDonacion()
    {
        try {
            $report = miembrosModel::reporteMiembros();
            $miembrosCollection = new miembrosCollection();
            $formatMiembrosReport = $miembrosCollection->formatMiembrosReport($report);
            $data = [
                'miembros' => $formatMiembrosReport,
            ];
            return json_encode($data);
        } catch (\Exception $ex) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex]);
            $data = [
                'title' => 'Error',
                'messages' => $ex,
                'code' => 403
            ];
            return json_encode($data);
        }
    }

    // Cantidad Grupos por mes 
    public function dataGrupos()
    {
        try {
            $report = grupoFamiliarModel::reporteGrupos();   
            $grupoFamiliarCollection = new grupoFamiliarCollection();
            $formatGruposReport = $grupoFamiliarCollection->formatGruposReport($report);         
            $data = [
                'grupos' => $formatGruposReport,
            ];
            return json_encode($data);

        } catch (\Exception $ex) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex]);
            $data = [
                'title' => 'Error',
                'messages' => $ex,
                'code' => 403
            ];
            return json_encode($data);
        }
    }

    // cantidad de amigos de cada grupo familiar
    public function dataGruposAmigos(Request $request)
    {
        try {
            $fechaInicial = !empty($request->getBody()['fecha_inicial']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_inicial'])->startOfDay()->format('Y-m-d H:i:s') : null;
            $fechaFinal = !empty($request->getBody()['fecha_final']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_final'])->endOfDay()->format('Y-m-d H:i:s') : null;
            if(!is_null($fechaInicial) && !is_null($fechaFinal)){
                $report = grupoFamiliarModel::reporteGrupos2($fechaInicial,$fechaFinal);
                $data = [
                    'gruposAmigos' => $report,
                ];
                return json_encode($data);
            } else {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => 'Debe ingresar una fecha inicial y una fecha final',
                    'code' => 422
                ];
                return json_encode($data, 422);
            }

       } catch (\Exception $ex) {
           $logger = new Logger("web");
           $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
           $logger->debug(__METHOD__, [$ex]);
           $data = [
               'title' => 'Error',
               'messages' => $ex,
               'code' => 403
           ];
           return json_encode($data);
       }

    }

    // cantidad de grupos ingresados por mes
    public function dataGruposIngresadosMes(Request $request)
    {
        try {
            $fechaInicial = !empty($request->getBody()['fecha_inicial']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_inicial'])->startOfDay()->format('Y-m-d H:i:s') : null;
            $fechaFinal = !empty($request->getBody()['fecha_final']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_final'])->endOfDay()->format('Y-m-d H:i:s') : null;
            if(!is_null($fechaInicial) && !is_null($fechaFinal)){
                $report = grupoFamiliarModel::reporteGrupos3($fechaInicial,$fechaFinal);
                $data = [
                    'gruposIngresados' => $report,
                ];
                return json_encode($data);
            } else {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => 'Debe ingresar una fecha inicial y una fecha final',
                    'code' => 422
                ];
                return json_encode($data, 422);
            }

       } catch (\Exception $ex) {
           $logger = new Logger("web");
           $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
           $logger->debug(__METHOD__, [$ex]);
           $data = [
               'title' => 'Error',
               'messages' => $ex,
               'code' => 403
           ];
           return json_encode($data);
       }

    }

}
