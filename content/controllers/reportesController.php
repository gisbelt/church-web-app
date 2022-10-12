<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\miembrosCollection;
use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\miembrosModel;
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

    public function dataMiembros(Request $request)
    {
        try {
             if(!empty($request->getBody()['fecha'])){
                 $fecha = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha'])->format('Y-m-d');
                 $report = miembrosModel::reporteMiembros($fecha);
                 $miembrosCollection = new miembrosCollection();
                 $formatMiembrosReport = $miembrosCollection->formatMiembrosReport($report);
                 $data = [
                     'miembros' => $formatMiembrosReport,
                 ];
                 return json_encode($data);
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
