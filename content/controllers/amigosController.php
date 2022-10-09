<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\amigosCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\amigosModel as amigos;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        usuarios::validarLogin();
        return $this->render('/miembros/amigos/consultarView');
    }

    public function create()
    {
        usuarios::validarLogin();
        return $this->render('/miembros/amigos/registrarView');
    }

    public function obtenerAmigos(Request $request)
    {
        try {
            $cedula = !empty($request->getBody()['cedula']) ? $request->getBody()['cedula'] : null;
            $sexo = !empty($request->getBody()['sexo']) ? $request->getBody()['sexo'] : null;
            $status = !empty($request->getBody()['status']) ? $request->getBody()['status'] : null;
            $fechaNacimiento = !empty($request->getBody()['fecha_nacimiento']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_nacimiento'])->format('Y-m-d') : null;
            if(!is_null($cedula) || !is_null($sexo) || !is_null($status) || !is_null($fechaNacimiento)){

                $amigos = amigos::obtenerAmigos($cedula, $sexo, $status, $fechaNacimiento);
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$amigos]);
                $amigosCollection = new amigosCollection();
                $dataAmigo = $amigosCollection->formatAmigos($amigos);
                $data = [
                    'amigos' => $dataAmigo,
                ];
            } else {
                $data = [
                    'amigos' => [],
                ];
            }

            return json_encode($data);

        }catch (\Exception $ex) {
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

    public function guardar(Request $request)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, ['request' => $request->getBody()]);
        try {
            $amigos = new amigos();
            $amigos->loadData($request->getBody());
            if($amigos->validate()) {
                if($request->getBody()['fecha_nacimiento'] != ''){
                    $cedulaAmigo = amigos::buscarAmigoCedula($request->getBody()['cedula']);
                    if(!is_null($cedulaAmigo)){
                        $cedula = $request->getBody()['cedula'];
                        $nombre = $request->getBody()['nombre'];
                        $apellido = $request->getBody()['apellido'];
                        $sexo = $request->getBody()['sexo'] == 'on' ? 1 : 0;
                        $direccion = $request->getBody()['direccion'];
                        $telefono = $request->getBody()['telefono'];
                        $comoLlego = $request->getBody()['como_llego'];
                        $fecha = Carbon::now();
                        $fechaNacimiento = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_nacimiento'])->format('Y-m-d H:i:s');

                        $amigos = amigos::guardar($cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $comoLlego, $fechaNacimiento, $fecha);
                        if ($amigos) {
                            $data = [
                                'title' => 'Datos registrado',
                                'messages' => 'El amigo se ha registrado',
                                'code' => 200
                            ];
                        } else {
                            $data = [
                                'title' => 'Error',
                                'messages' => 'El amigo no se ha registrado',
                                'code' => 500
                            ];
                        }
                        return json_encode($data);
                    } else {
                        $data = [
                            'title' => 'Amigo',
                            'messages' => 'Este amigo ya esta registrado',
                            'code' => 200
                        ];
                        return json_encode($data, 200);
                    }
                } else {
                    $amigos->addError("fecha naciemiento", "La fecha nacimiento es requerida");
                }
            }
            if (count($amigos->errors) > 0) {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => $amigos->errors,
                    'code' => 422
                ];
                return json_encode($data, 422);
            }

        }catch (\Exception $ex) {
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

    public function eliminar(Request $request)
    {
        usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $id = $request->getRouteParam('id');
        if(!is_null($id)){
            $usuario = amigos::eliminar($id);
            if($usuario){
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
            'messages' => 'Algo salio mal intente mas tardes',
            'code' => 422
        ];
        return json_encode($data, 422);
    }

}