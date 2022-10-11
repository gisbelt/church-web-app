<?php

namespace content\controllers;

use Carbon\Carbon;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\bitacoraModel;
use content\models\usuariosModel as usuarios;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class bitacoraController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['bitacoraDatos']));
    }

    public function index()
    {
        if (!in_array(permisos::$bitacora, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        bitacoraModel::guardar('Ingreso en bitacora', 'Index bitacora');
        usuarios::validarLogin();
        $usuarios = usuarios::usuarioBitacora();
        return $this->render('bitacora/consultarView', [
            'usuarios' => $usuarios
        ]);
    }

    public function bitacoraDatos(Request $request)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));

        try {
            $user = !empty($request->getBody()['user']) ? $request->getBody()['user'] : null;
            $fechaInicial = !empty($request->getBody()['fecha_inicial']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_inicial'])->startOfDay()->format('Y-m-d H:i:s') : null;
            $fechaFinal = !empty($request->getBody()['fecha_final']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_final'])->endOfDay()->format('Y-m-d H:i:s') : null;
            if (!is_null($fechaInicial) && !is_null($fechaFinal)){
                $bitacora = bitacoraModel::consultar($user, $fechaInicial, $fechaFinal);
                $logger->debug(__METHOD__, [$bitacora]);
                $data = [
                    'bitacora' => $bitacora,
                ];
            } else {
                $data = [
                    'bitacora' => [],
                ];
            }

            return json_encode($data);

        } catch (\Exception $ex) {
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$ex, 'request' => $request]);
            $data = [
                'title' => 'Error',
                'messages' => $ex,
                'code' => 403
            ];
            return json_encode($data);
        }
    }
}