<?php

use content\controllers\AutenticacionController;
use content\controllers\actividadController;
use content\controllers\amigosController;
use content\controllers\asistenciasController;
use content\controllers\bitacoraController;
use content\controllers\donacionesController;
use content\controllers\grupoFamiliarController;
use content\controllers\homeController;
use content\controllers\miembrosController;
use content\controllers\reportesController;
use content\controllers\seguridadController;
use content\controllers\usuariosController;
use content\controllers\perfilController;
use content\controllers\errorController;
use content\enums\permisos;

if (!function_exists("routas")) {

    function rutas()
    {
        $rutas = [
            'login' => [
                'controller' => AutenticacionController::class,
                'permisos' => [],
                'parametros' => [],
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'login',
                'subRutas' => [
                    'loginView' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'index',
                        'route' => '/',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'loginPost' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'login',
                        'route' => '/login',
                        'method' => 'iniciar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'logout' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'logout',
                        'route' => '/logout',
                        'method' => 'cerrarSesion',
                        'action' => 'get'
                    ],

                    'recuperarContrasena' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'recuperar-contrasena',
                        'route' => '/recuperar-contrasena',
                        'method' => 'recuperarContrasena',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'resetearContrasena' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'resetear-contrasena',
                        'route' => '/resetear-contrasena',
                        'method' => 'resetearContrasena',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'enviarCorreo' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'login',
                        'route' => '/enviar/correo',
                        'method' => 'verificarCorreo',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'cambiarContrasena' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'cambiar-contrasena',
                        'route' => '/cambiar-contrasena/{id}',
                        'method' => 'cambiarContrasena',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ],
            ],

            'home' => [
                'controller' => homeController::class,
                'permisos' => permisos::$home,
                'parametros' => [],
                'icon' => 'bx bx-home-circle',
                'text' => 'home',
                'subRutas' => [
                    'homeView' => [
                        'permisos' => permisos::$home,
                        'parametros' => [],
                        'text' => 'home',
                        'icon' => 'bx bx-view-list',
                        'route' => '/home',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'proximasActividades' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Proximas Actividades',
                        'icon' => 'bx bx-view-list',
                        'route' => '/home/proximas-actividades',
                        'method' => 'proximasActividades',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'bitacoraLastActions' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Bitacora Ultimas Acciones',
                        'icon' => 'bx bx-view-list',
                        'route' => '/home/bitacora-last',
                        'method' => 'bitacoraLastActions',
                        'action' => 'get',
                        'subRutas' => []
                    ]
                ]
            ],

            'error' => [
                'controller' => errorController::class,
                'parametros' => [],
                'icon' => 'bx bx-bar-chart-alt-2',
                'permisos' => [],
                'text' => 'error',
                'subRutas' => [
                    'errorView' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'error',
                        'route' => '/error',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ]
                ]
            ],

            'miembros' => [
                'controller' => miembrosController::class,
                'permisos' => permisos::$miembros,
                'parametros' => [],
                'route' => null,
                'text' => 'Miembros',
                'icon' => 'bx bx-group',
                'subRutas' => [
                    'listaMiembros' => [
                        'permisos' => permisos::$lista_miembros,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de miembros',
                        'route' => '/miembros',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'listaDataMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de miembros',
                        'route' => '/miembros/data',
                        'method' => 'consultarMiembros',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearMiembros' => [
                        'permisos' => permisos::$crear_miembros,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar miembros',
                        'route' => '/miembros/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar miembros',
                        'route' => '/miembros/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'borraMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/miembros/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'desactivarMiembro',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'editarMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar Permisos',
                        'route' => '/miembros/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Actualizar usuarios',
                        'route' => '/miembros/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'amigos' => [
                'controller' => amigosController::class,
                'permisos' => permisos::$amigos,
                'parametros' => [],
                'route' => null,
                'icon' => 'bx bx-smile',
                'text' => 'Amigos',
                'subRutas' => [
                    'listaAmigos' => [
                        'permisos' => permisos::$lista_amigos,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de amigo',
                        'route' => '/amigos',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de amigos',
                        'route' => '/amigos/data',
                        'method' => 'obtenerAmigos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAmigos' => [
                        'permisos' => permisos::$crear_amigos,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registra amigo',
                        'route' => '/amigos/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar amigo',
                        'route' => '/amigo/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'eliminarAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Convertir amigos',
                        'route' => '/amigos/converti-miembro', //{id:\d+}/{username} {id}
                        'method' => 'convertirMiembro',
                        'action' => 'post',
                        'subRutas' => [],
                    ],

                    'editarAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar amigos',
                        'route' => '/amigos/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/amigos/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'donaciones' => [
                'controller' => donacionesController::class,
                'permisos' => permisos::$donacion,
                'parametros' => [],
                'route' => null,
                'text' => 'Donaciones',
                'icon' => 'bx bx-donate-heart',
                'subRutas' => [
                    'listaDonaciones' => [
                        'permisos' => permisos::$lista_donacion,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de donaciones',
                        'route' => '/donaciones',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de donaciones',
                        'route' => 'donaciones/data',
                        'method' => 'obtenerDonaciones',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearDonaciones' => [
                        'permisos' => permisos::$crear_donacion,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar donaciones',
                        'route' => '/donaciones/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'guardar donaciones',
                        'route' => '/donaciones/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'editarDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar donacion',
                        'route' => '/donaciones/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/donacion/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'eliminarDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Eliminar donacion',
                        'route' => '/donaciones/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'observacionDonacionesGuardar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'guardar observacion',
                        'route' => '/donaciones/guardar-observacion', //{id:\d+}/{username} {id}
                        'method' => 'guardarObservacionDonacion',
                        'action' => 'post',
                        'subRutas' => [],
                    ],
                ]
            ],

            'actividades' => [
                'controller' => actividadController::class,
                'permisos' => permisos::$actividades,
                'parametros' => [],
                'route' => null,
                'text' => 'Actividades',
                'icon' => 'bx bx-briefcase-alt',
                'subRutas' => [
                    'listaActividades' => [
                        'permisos' => permisos::$actividades,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de actividades',
                        'route' => '/actividades',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearActividades' => [
                        'permisos' => permisos::$crear_actividades,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar actividades',
                        'route' => '/actividades/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                    'registrarActividades' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar actividades',
                        'route' => '/actividades/store',
                        'method' => 'store',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                    'editarActividades' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Actualizar actividades',
                        'route' => '/actividades/editar/{id}',
                        'method' => 'edit',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                    'actualizarActividades' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => '',
                        'route' => '/actividades/update',
                        'method' => 'update',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                    'dataActividades' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Activdades',
                        'route' => 'actividad/data',
                        'method' => 'obtenerActividades',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                    'tipoActividad' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'tipo de actividad',
                        'route' => '/actividad/tipos',
                        'method' => 'obtenerTiposActividad',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                    'selectMiembros' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'select miembros',
                        'route' => '/miembros/select',
                        'method' => 'obtenerMiembros',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'asitencias' => [
                'controller' => asistenciasController::class,
                'permisos' => permisos::$asitencias,
                'parametros' => [],
                'route' => null,
                'icon' => 'bx bx-list-check',
                'text' => 'Asistencias',
                'subRutas' => [
                    'listaAsistencias' => [
                        'permisos' => permisos::$lista_asitencias,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de asistencias',
                        'route' => '/asistencias',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAsistencias' => [
                        'permisos' => permisos::$crear_asitencias,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar asistencias',
                        'route' => '/asistencias/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarAsistencias' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/asistencias/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'dataAsistencias' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de donaciones',
                        'route' => '/asistencias/data',
                        'method' => 'obtenerAsistencias',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'editarAsistencias' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Actualizar actividades',
                        'route' => '/asistencias/editar/{id}',
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'actualizarAsistencias' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Actualizar actividades',
                        'route' => '/asistencias/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'eliminarAsistencia' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Eliminar donacion',
                        'route' => '/asistencias/eliminar/{id}', 
                        'method' => 'eliminar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],
                ]
            ],

            'grupoFamiliares' => [
                'controller' => grupoFamiliarController::class,
                'permisos' => permisos::$grupo_familiar,
                'parametros' => [],
                'route' => null,
                'text' => 'Grupo familiar',
                'icon' => 'bx bx-group',
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'permisos' => permisos::$lista_grupo_familiar,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de grupos familiar',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearGrupoFamiliares' => [
                        'permisos' => permisos::$crear_grupo_familiar,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar grupo familiar',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataGrupos' => [
                        'permisos' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'parametros' => [],
                        'text' => 'Obtener Grupos',
                        'route' => '/grupo-familiares/data',
                        'method' => 'obtenerGrupos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataAmigos' => [
                        'permisos' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'parametros' => [],
                        'text' => 'Obtener Amigos',
                        'route' => '/grupo-familiares/data-amigos',
                        'method' => 'obtenerAmigos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarAmigo' => [
                        'permisos' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'parametros' => [],
                        'text' => 'Buscar Amigo',
                        'route' => '/grupo-familiares/buscar-amigo',
                        'method' => 'buscarAmigo',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'obtenerIntegrantesGrupo' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/grupo-familiares/obtener-integrantes',
                        'method' => 'obtenerIntegrantesGrupo',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarGrupoFamiliar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/grupo-familiares/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'editarGrupoFamiliar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar Grupo Familiar',
                        'route' => '/grupo-familiares/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarGrupoFamiliar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/grupo-familiares/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'eliminarGrupoFamiliar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Eliminar Grupo Familiar',
                        'route' => '/grupo-familiares/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'asignarAmigos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Asignar Amigos',
                        'route' => '/grupo-familiares/asignar-amigos', //{id:\d+}/{username} {id}
                        'method' => 'asignarAmigos',
                        'action' => 'post',
                        'subRutas' => [],
                    ],

                    'eliminarAmigo' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Asignar Amigos',
                        'route' => '/grupo-familiares/eliminar-amigo/{id}/{grupo_id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminarAmigo',
                        'action' => 'get',
                        'subRutas' => [],
                    ],
                ]
            ],

            'usuarios' => [
                'controller' => usuariosController::class,
                'icon' => 'bx bx-user',
                'permisos' => permisos::$usuarios,
                'parametros' => [],
                'route' => null,
                'text' => 'Usuarios',
                'subRutas' => [
                    'listaUsuarios' => [
                        'permisos' => permisos::$usuarios,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de usuarios',
                        'route' => '/usuarios',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearUsuarios' => [
                        'permisos' => permisos::$usuarios_crear,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar usuarios',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarUsuarios' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/usuarios/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'buscarUsuario' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'text' => 'Buscar usuarios',
                        'route' => '/usuarios/buscar-usuario',
                        'method' => 'buscarUsuario',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'dataUsuarios' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de usaurios',
                        'route' => '/usuarios/data',
                        'method' => 'obtenerUsuarios',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'borraUsuarios' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/usuarios/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminar',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'editarUsuarios' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar Permisos',
                        'route' => '/usuarios/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarUsuarios' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Actualizar usuarios',
                        'route' => '/usuario/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'reportes' => [
                'permisos' => permisos::$reportes,
                'parametros' => [],
                'icon' => 'bx bxs-report',
                'text' => 'Reportes',
                'controller' => reportesController::class,
                'route' => null,
                'subRutas' => [

                    'indexReport' => [
                        'permisos' => permisos::$reportes,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista reportes',
                        'route' => '/reportes',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'donacionReport' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista reportes',
                        'route' => '/reportes/donacion',
                        'method' => 'dataDonacion',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'gruposReport' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Grupos Familiares Reportes',
                        'route' => '/reportes/grupos',
                        'method' => 'dataGrupos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'gruposAmigosReport' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Cantidad Amigos Grupo',
                        'route' => '/reportes/gruposAmigos',
                        'method' => 'dataGruposAmigos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'gruposIngresadosMesReport' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Grupos Ingresados Mes',
                        'route' => '/reportes/grupos-ingresados-mes',
                        'method' => 'dataGruposIngresadosMes',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'Seguridad' => [
                'permisos' => permisos::$seguridad,
                'parametros' => [],
                'icon' => 'bx bx-lock',
                'text' => 'Seguridad',
                'controller' => seguridadController::class,
                'route' => null,
                'subRutas' => [
                    // permisos
                    'listaPermisos' => [
                        'permisos' => permisos::$seguridad,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de permisos',
                        'route' => '/seguridad/permisos',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataPermisos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de permisos',
                        'route' => '/seguridad/permisos/data',
                        'method' => 'obtenerPermisos',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearPermisos' => [
                        'permisos' => permisos::$seguridad,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar permisos',
                        'route' => '/seguridad/permisos/crear',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarPermisos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/permisos/guardar',
                        'method' => 'guardar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'borraPermisos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/permisos/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminar',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'editarPermiso' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar Permisos',
                        'route' => '/seguridad/permisos/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editar',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarPermisos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/permisos/actualizar',
                        'method' => 'actualizar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    //roles
                    'listaRoles' => [
                        'permisos' => permisos::$seguridad,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de roles',
                        'route' => '/seguridad/roles',
                        'method' => 'indexRol',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'dataRoles' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de roles',
                        'route' => '/seguridad/roles/data',
                        'method' => 'obtenerRoles',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearRoles' => [
                        'permisos' => permisos::$seguridad,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar roles',
                        'route' => '/seguridad/roles/crear',
                        'method' => 'createRol',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'guardarRoles' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/roles/guardar',
                        'method' => 'guardarRol',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'borraRoles' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/roles/eliminar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'eliminarRol',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'editarRoles' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-pencil',
                        'text' => 'Editar Roles',
                        'route' => '/seguridad/roles/editar/{id}', //{id:\d+}/{username} {id}
                        'method' => 'editarRol',
                        'action' => 'get',
                        'subRutas' => [],
                    ],

                    'actualizarRole' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'index',
                        'route' => '/seguridad/roles/actualizar',
                        'method' => 'actualizarRol',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'Bitacora' => [
                'permisos' => permisos::$bitacora,
                'parametros' => [],
                'controller' => bitacoraController::class,
                'icon' => 'bx bx-log-in-circle',
                'text' => 'Bitacora',
                'route' => null,
                'method' => 'index',
                'action' => 'get',
                'subRutas' => [

                    'BitacoraIndex' => [
                        'permisos' => permisos::$bitacora,
                        'parametros' => [],
                        'icon' => 'bx bx-log-in-circle',
                        'text' => 'Reporte bitacora',
                        'route' => '/Bitacora',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'BitacoraDatos' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-log-in-circle',
                        'text' => 'datos bitacora',
                        'route' => '/bitacora/data',
                        'method' => 'bitacoraDatos',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'Ayuda' => [
                'controller' => ayudaController::class,
                'icon' => 'bx bx-help-circle',
                'text' => 'Ayuda',
                'route' => '/Ayuda',
                'method' => 'index',
                'action' => 'get',
                'permisos' => permisos::$ayuda,
                'sinSubRutas' => 'ok',
                'subRutas' => []
            ],

            'perfil' => [
                'permisos' => permisos::$perfiles,
                'parametros' => [],
                'controller' => perfilController::class,
                'icon' => '',
                'route' => null,
                'text' => 'Perfil',
                'subRutas' => [
                    'cuenta' => [
                        'permisos' => permisos::$perfiles,
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'obtenerUsuario' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta/obtener-usuario',
                        'method' => 'obtener_usuario',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'actualizarUsername' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta/actualizar-username',
                        'method' => 'actualizar_username',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'actualizarNombre' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta/actualizar-nombre',
                        'method' => 'actualizar_nombre',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'actualizarTelefono' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta/actualizar-telefono',
                        'method' => 'actualizar_telefono',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'actualizarDireccion' => [
                        'permisos' => [],
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta/actualizar-direccion',
                        'method' => 'actualizar_direccion',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'preferencias' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'Preferencias',
                        'route' => '/preferencias',
                        'method' => 'preferencias',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],
        ];
        return json_decode(json_encode($rutas));
    }
}