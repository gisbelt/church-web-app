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
use content\models\cargosModel;
use content\models\membresiasModel;
use content\models\miembrosModel;
use content\models\perfilesModel;
use content\models\profesionModel;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['actualizar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['editar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['obtenerAmigos']));
        $this->registerMiddleware(new AutenticacionMiddleware(['guardar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['convertirMiembro']));
    }

    // Editar datos de usuario
    public function actualizar(Request $request)
    {
        usuarios::validarLogin();
        $amigos = new amigos();
        $amigos->loadData($request->getBody());
        if ($amigos->validate()) {
            if ($request->getBody()['fecha_nacimiento'] != '') {
                $id = $request->getBody()['id'];
                $cedula = $request->getBody()['cedula'];
                $nombre = $request->getBody()['nombre'];
                $apellido = $request->getBody()['apellido'];
                $sexo = $request->getBody()['sexo'] == 'on' ? 1 : 0;
                $direccion = $request->getBody()['direccion'];
                $telefono = $request->getBody()['telefono'];
                $comoLlego = $request->getBody()['como_llego'];
                $fecha = Carbon::now();
                $fechaNacimiento = Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_nacimiento'])->format('Y-m-d H:i:s');
                $amigo = amigos::actualizar($id, $cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $comoLlego, $fechaNacimiento, $fecha);
                if ($amigo) {
                    $data = [
                        'title' => 'Datos actualizado',
                        'messages' => 'El usuario se ha actualizado',
                        'code' => 200
                    ];
                } else {
                    $data = [
                        'title' => 'Error',
                        'messages' => 'El usuario no se ha actualizado',
                        'code' => 422
                    ];
                }
                return json_encode($data);
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
    }

    // Mostrar vista lista de amigos
    public function index()
    {
        usuarios::validarLogin();
        $profesiones = profesionModel::obtener_profesiones();
        $membresias = membresiasModel::obtener_membresias();
        $cargos = cargosModel::obtener_cargos();
        return $this->render('/miembros/amigos/consultarView', [
            'profesiones' => $profesiones,
            'membresias' => $membresias,
            'cargos' => $cargos
        ]);
    }

    // Mostrar vista crear de amigos
    public function create()
    {
        usuarios::validarLogin();
        return $this->render('/miembros/amigos/registrarView');
    }

    // Mostrar vista editar de amigos
    public function editar(Request $request)
    {
        usuarios::validarLogin();
        $id = $request->getRouteParams();
        $amigo = amigos::amigoId($id['id']);
        return $this->render('/miembros/amigos/editarView', [
            'id' => $id['id'],
            'nombre' => $amigo['nombre'],
            'apellido' => $amigo['apellido'],
            'cedula' => $amigo['cedula'],
            'telefono' => $amigo['telefono'],
            'direccion' => $amigo['direccion'],
            'sexo' => $amigo['sexo'],
            'status' => $amigo['status'],
            'como_llego' => $amigo['como_llego'],
            'fecha_nacimiento' => Carbon::createFromFormat('Y-m-d H:i:s', $amigo['fecha_nacimiento'])->format('d-m-Y')
        ]);
    }

    // Obtener amigos
    public function obtenerAmigos(Request $request)
    {
        try {
            $cedula = !empty($request->getBody()['cedula']) ? $request->getBody()['cedula'] : null;
            $sexo = !empty($request->getBody()['sexo']) ? $request->getBody()['sexo'] : null;
            $fechaNacimiento = !empty($request->getBody()['fecha_nacimiento']) ? Carbon::createFromFormat('d-m-Y', $request->getBody()['fecha_nacimiento'])->format('Y-m-d') : null;
            if (!is_null($cedula) || !is_null($sexo) || !is_null($fechaNacimiento)) {

                $amigos = amigos::obtenerAmigos($cedula, $sexo, $fechaNacimiento);
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

    // Guardar datos de amigos
    public function guardar(Request $request)
    {
        try {
            $amigos = new amigos();
            $amigos->loadData($request->getBody());
            if ($amigos->validate()) {
                if ($request->getBody()['fecha_nacimiento'] != '') {
                    $cedulaAmigo = amigos::buscarAmigoCedula($request->getBody()['cedula']);
                    if (!is_null($cedulaAmigo)) {
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

    // Convertir amigo a miembro
    public function convertirMiembro(Request $request)
    {
        usuarios::validarLogin();
        if (!in_array(permisos::$seguridad, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        try {
            $miembros = new miembrosModel();
            $perfiles = new perfilesModel();
            $miembros->loadData($request->getBody());
            $amigos = new amigos();
            $id = $request->getBody()['amigo_id'];
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            if (!is_null($id)) {
                if (!empty($request->getBody()['membresia']) && !empty($request->getBody()['cargo'])) {
                    $amigosData = $amigos::amigoId($id);
                    $perfiles->loadData($amigosData);
                    if($perfiles->validate()) {
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
                        $logger->debug(__METHOD__, [$fechaPasoFe, $fechaBautismo, $membresia, $cargo, $fecha]);
                        $miembro = miembrosModel::crear($fechaPasoFe, $fechaBautismo, $membresia, $cargo, $fecha);

                        if($miembro){
                            $miembroId = $miembro;
                            $cedula = $amigosData['cedula'];
                            $nombre = $amigosData['nombre'];
                            $apellido = $amigosData['apellido'] ?? NULL;
                            if ($amigosData['fecha_nacimiento'] != NULL) {
                                $fechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $amigosData['fecha_nacimiento'])->format('Y-m-d H:i:s');
                            } else {
                                $fechaNacimiento = NULL;
                            }

                            $telefono = $amigosData['telefono'] ?? NULL;
                            $direccion = $amigosData['direccion'] ?? NULL;
                            $disponibilidad = NULL;
                            $gradoInstruccion = NULL;
                            $sexo = $amigosData['sexo'] ?? 1;
                            $vehiculo = 0;
                            $profesionId = 73;
                            $perfil = perfilesModel::crear($miembroId, $cedula, $nombre, $apellido, $fechaNacimiento,
                                $telefono, $direccion, $disponibilidad, $gradoInstruccion,
                                $sexo, $vehiculo, $profesionId, $fecha);

                            if ($perfil) {
                                $amigos::covertirMiembro($request->getBody()['amigo_id']);
                                $data = [
                                    'title' => 'Datos registrado',
                                    'messages' => 'El amigo se ha convertido en miembro',
                                    'code' => 200
                                ];
                            } else {
                                $data = [
                                    'title' => 'Error',
                                    'messages' => 'El amigo no se ha podido convertir a miembro',
                                    'code' => 500
                                ];
                            }
                            return json_encode($data);
                        }
                    }
                }else {
                    if (empty($request->getBody()['membresia']) && empty($request->getBody()['cargo'])) {
                        $miembros->addError("cargo", "El campo cargo es requerido");
                        $miembros->addError("membresia", "El campo membresia es requerido");
                    } else if (empty($request->getBody()['membresia'])) {
                        $miembros->addError("membresia", "El campo membresia es requerido");
                    } else if (empty($request->getBody()['cargo'])) {
                        $miembros->addError("cargo", "El campo cargo es requerido");
                    }
                }
            } else {
                $data = [
                    'title' => 'Error',
                    'messages' => 'El amigo no se ha encontrado',
                    'code' => 422
                ];
                return json_encode($data);
            }
            if(count($amigos->errors)>0){
                $data = [
                    'title' => 'Error',
                    'messages' => $amigos->errors,
                    'code' => 422
                ];
            } else if(count($miembros->errors)>0) {
                $data = [
                    'title' => 'Error',
                    'messages' => $miembros->errors,
                    'code' => 422
                ];
            } else if(count($perfiles->errors)>0){
                $data = [
                    'title' => 'Error',
                    'messages' => $perfiles->errors,
                    'code' => 422
                ];
            }

            return json_encode($data, 422);
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