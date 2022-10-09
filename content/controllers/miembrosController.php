<?php

namespace content\controllers;

use Carbon\Carbon;
use content\collections\miembrosCollection;
use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\core\Request;
use content\enums\permisos;
use content\models\cargosModel;
use content\models\membresiasModel;
use content\models\miembrosModel;
use content\models\usuariosModel as usuarios;
use content\models\perfilesModel;
use content\models\profesionModel;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class miembrosController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['consultarMiembros']));
        $this->registerMiddleware(new AutenticacionMiddleware(['registrar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['desactivarMiembro']));
    }

    public function index()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        return $this->render('miembros/miembros/consultarView');
    }

    public function consultarMiembros(Request $request)
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        try {
            $nombre = count($request->getBody()) > 1 ? $request->getBody()['nombre'] : null;
            $sexo = count($request->getBody()) > 1 ? $request->getBody()['sexo'] : null;
            $tipo_fecha = count($request->getBody()) > 1 ? $request->getBody()['tipo_fecha'] : null;
            $fecha = !empty($request->getBody()['fecha'])  ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha'])->format('Y-m-d') : null;
            if ($nombre != '' || $sexo  != '' || $tipo_fecha  != '' || $fecha  != '') {
                $miembros = miembrosModel::obtener_miembros_filtro($nombre, $sexo, $tipo_fecha, $fecha);
                if ($miembros) {
                    $miembrosCollection = new miembrosCollection();
                    $miembrosFormat = $miembrosCollection->formatMiembros($miembros);
                } else {
                    $usuariosFormat = [];
                }
                $data = [
                    'miembros' => $miembrosFormat,
                ];
            } else {
                $data = [
                    'miembros' => [],
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

    public function registrar()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        return $this->render('miembros/miembros/consultarView', [
            'profesiones' => $profesiones
        ]);
    }

    public function create()
    {
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        $membresias = membresiasModel::obtener_membresias();
        $cargos = cargosModel::obtener_cargos();
        return $this->render('miembros/miembros/registrarView', [
            'profesiones' => $profesiones,
            'membresias' => $membresias,
            'cargos' => $cargos
        ]);
    }

    public function guardar(Request $request)
    {

        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $errors = [];
        $miembros = new miembrosModel();
        $perfiles = new perfilesModel();
        $miembros->loadData($request->getBody());
        try {
            usuarios::validarLogin();
            if (!empty($request->getBody()['membresia']) && !empty($request->getBody()['cargo'])) {
                $perfiles->loadData($request->getBody());
                if ($perfiles->validate()) {
                    $perfilData = perfilesModel::obtener_miembro_cedula($request->getBody()['cedula']);
                    if (!$perfilData) {
                        if ($request->getBody()['fecha_paso_fe'] != "") {
                            $fechaPasoFe = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_paso_fe'])->format('Y-m-d H:i:s');
                        } else {
                            $fechaPasoFe = NULL;
                        }
                        if ($request->getBody()['fecha_bautismo'] != "") {
                            $fechaBautismo = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_bautismo'])->format('Y-m-d H:i:s');
                        } else {
                            $fechaBautismo = NULL;
                        }
                        $membresia = $request->getBody()['membresia'];
                        $cargo = $request->getBody()['cargo'];
                        $fecha = Carbon::now();
                        $miembro = miembrosModel::crear($fechaPasoFe, $fechaBautismo, $membresia, $cargo, $fecha);
                        $logger->debug(__METHOD__, [$miembro]);
                        if ($miembro) {
                            $miembroId = $miembro;
                            $cedula = $request->getBody()['cedula'];
                            $nombre = $request->getBody()['nombre'];
                            $apellido = $request->getBody()['apellido'];
                            if ($request->getBody()['fecha_nacimiento'] != "") {
                                $fechaNacimiento = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_nacimiento'])->format('Y-m-d H:i:s');
                            } else {
                                $fechaNacimiento = NULL;
                            }

                            $telefono = $request->getBody()['telefono'];
                            $direccion = $request->getBody()['direccion'];
                            $disponibilidad = $request->getBody()['disponibilidad'];
                            $gradoInstruccion = $request->getBody()['grado_instruccion'];
                            $sexo = $request->getBody()['sexo'] == 'on' ? 1 : 0;
                            $vehiculo = $request->getBody()['vehiculo'] == 'on' ? 1 : 0;
                            $profesionId = $request->getBody()['profesion'];
                            $perfil = perfilesModel::crear($miembroId, $cedula, $nombre, $apellido, $fechaNacimiento,
                                $telefono, $direccion, $disponibilidad, $gradoInstruccion,
                                $sexo, $vehiculo, $profesionId, $fecha);

                            if ($perfil) {
                                $data = [
                                    'title' => 'Datos registrado',
                                    'messages' => 'El miemrbo se ha registrado',
                                    'code' => 200
                                ];
                            } else {
                                $data = [
                                    'title' => 'Error',
                                    'messages' => 'El miembro no se ha registrado',
                                    'code' => 500
                                ];
                            }
                            return json_encode($data);
                        }
                    } else {
                        $data = [
                            'title' => 'Miembro',
                            'messages' => 'Este miembro ya esta registrado',
                            'code' => 200
                        ];
                        return json_encode($data, 200);
                    }

                }
                $miembros->errors = array_merge($miembros->errors, $perfiles->errors);
            } else {
                if (empty($request->getBody()['membresia']) && empty($request->getBody()['cargo'])) {
                    $miembros->addError("cargo", "El campo cargo es requerido");
                    $miembros->addError("membresia", "El campo membresia es requerido");
                } else if (empty($request->getBody()['membresia'])) {
                    $miembros->addError("membresia", "El campo membresia es requerido");
                } else if (empty($request->getBody()['cargo'])) {
                    $miembros->addError("cargo", "El campo cargo es requerido");
                }
            }
            if (count($miembros->errors) > 0) {
                $data = [
                    'title' => 'Datos invalidos',
                    'messages' => $miembros->errors,
                    'code' => 422
                ];
                return json_encode($data, 422);
            }

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

    public function desactivarMiembro(Request $request)
    {
        usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
       try{
           $id = $request->getRouteParam('id');
           if(!is_null($id)){
               $usuario = miembrosModel::eliminar($id);
               if($usuario){
                   $data = [
                       'title' => 'Dato eliminado',
                       'messages' => 'El miembro se ha eliminado',
                       'code' => 200
                   ];
               } else {
                   $data = [
                       'title' => 'Error',
                       'messages' => 'El miembro no se ha eliminado',
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
}