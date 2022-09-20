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
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'login',
                'subRutas' => [
                    'loginView' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'index',
                        'route' => '/',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'loginPost' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'login',
                        'route' => '/login',
                        'method' => 'iniciar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'logout' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'logout',
                        'route' => '/logout',
                        'method' => 'cerrarSesion',
                        'action' => 'get'
                    ],

                    'recuperarContrasena' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'recuperar-contrasena',
                        'route' => '/recuperar-contrasena',
                        'method' => 'recuperarContrasena',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'cambiarContrasena' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'cambiar-contrasena',
                        'route' => '/cambiar-contrasena',
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
                    ]
                ]
            ],

            'error' => [
                'controller' => errorController::class,
                'parametros' => [],
                'icon' => 'bx bx-bar-chart-alt-2',
                'permisos' => permisos::$permiso,
                'text' => 'error',
                'subRutas' => [
                    'errorView' => [
                        'permisos' => permisos::$permiso,
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
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'text' => 'Miembros',
                'icon' => 'bx bx-group',
                'subRutas' => [
                    'listaMiembros' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Miembros',
                        'route' => '/miembros',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearMiembros' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Miembros',
                        'route' => '/miembros/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'amigos' => [
                'controller' => amigosController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'icon' => 'bx bx-smile',
                'text' => 'Amigos',
                'subRutas' => [
                    'listaAmigos' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Amigos',
                        'route' => '/amigos',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAmigos' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Amigos',
                        'route' => '/amigos/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'donaciones' => [
                'controller' => donacionesController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'text' => 'Donaciones',
                'icon' => 'bx bx-donate-heart',
                'subRutas' => [
                    'listaDonaciones' => [
                        'permisos' => permisos::$donaciones,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Donaciones',
                        'route' => '/donaciones',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearDonaciones' => [
                        'permisos' => permisos::$donaciones,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Donación',
                        'route' => '/donaciones/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'obtenerDonaciones' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Obtener Donaciones',
                        'route' => '/donaciones/obtener-donaciones',
                        'method' => 'obtenerDonaciones',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'actividades' => [
                'controller' => actividadController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'text' => 'Actividades',
                'icon' => 'bx bx-briefcase-alt',
                'subRutas' => [
                    'listaActividades' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Actividades',
                        'route' => '/actividades',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearActividades' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Actividad',
                        'route' => '/actividades/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'asitencias' => [
                'controller' => asistenciasController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'icon' => 'bx bx-list-check',
                'text' => 'Asistencias',
                'subRutas' => [
                    'listaAsistencias' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista de Asistencias',
                        'route' => '/asistencias',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAsistencias' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Asistencia',
                        'route' => '/asistencias/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'grupoFamiliares' => [
                'controller' => grupoFamiliarController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'route' => null,
                'text' => 'Grupo familiar',
                'icon' => 'bx bx-group',
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-list-ul',
                        'text' => 'Lista Grupo Familiar',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearGrupoFamiliares' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Grupo Familiar',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarMiembro' => [
                        'permisos' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'parametros' => [],
                        'text' => 'Buscar miembro',
                        'route' => '/grupo-familiares/buscar-miembro',
                        'method' => 'buscarMiembro',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'registrarGrupoFamiliar' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar grupo familiar',
                        'route' => '/grupo-familiares/registrar-grupoFamiliar',
                        'method' => 'registrarGrupoFamiliar',
                        'action' => 'post',
                        'subRutas' => []
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
                        'text' => 'Lista de Usuarios',
                        'route' => '/usuarios',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearUsuarios' => [
                        'permisos' => permisos::$usuarios_crear,
                        'parametros' => [],
                        'icon' => 'bx bx-save',
                        'text' => 'Registrar Usuarios',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarUsuario' => [
                        'permisos' => [],
                        'parametros' => [],
                        'icon' => 'bx bx-search-alt-2',
                        'text' => 'Buscar Usuarios',
                        'route' => '/usuarios/buscar-usuario',
                        'method' => 'buscarUsuario',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'reportes' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'icon' => 'bx bxs-report',
                'text' => 'Reportes',
                'controller' => reportesController::class,
                'route' => '/reportes',
                'method' => 'index',
                'action' => 'get',
                'sinSubRutas' => 'ok',
                'subRutas' => []
            ],

            'Seguridad' => [
                'permisos' => permisos::$seguridad,
                'parametros' => [],
                'icon' => 'bx bx-lock',
                'text' => 'Seguridad',
                'controller' => seguridadController::class,
                'route' => '/seguridad',
                'method' => 'index',
                'action' => 'get',
                'sinSubRutas' => 'ok',
                'subRutas' => []
            ],

            'Bitacora' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'controller' => bitacoreController::class,
                'icon' => 'bx bx-log-in-circle',
                'text' => 'Bitacora',
                'route' => '/Bitacora',
                'method' => 'index',
                'action' => 'get',
                'sinSubRutas' => 'ok',
                'subRutas' => []
            ],

            'Ayuda' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'controller' => ayudaController::class,
                'icon' => 'bx bx-help-circle',
                'text' => 'Ayuda',
                'route' => '/Ayuda',
                'method' => 'index',
                'action' => 'get',
                'sinSubRutas' => 'ok',
                'subRutas' => []                
            ],

            'perfil' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'controller' => perfilController::class,
                'icon' => '',
                'route' => null,
                'text' => 'Perfil',
                'subRutas' => [
                    'cuenta' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'text' => 'Cuenta',
                        'icon' => '',
                        'route' => '/cuenta',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'preferencias' => [
                        'permisos' => permisos::$permiso,
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