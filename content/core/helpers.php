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
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'home',
                'subRutas' => [
                    'homeView' => [
                        'permisos' => permisos::$home,
                        'parametros' => [],
                        'text' => 'home',
                        'icon' => 'bx bx-bar-chart-alt-2',
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
                'text' => 'miembros',
                'icon' => 'bx bx-user-check',
                'subRutas' => [
                    'listaMiembros' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'lista-miembros',
                        'route' => '/miembros',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearMiembros' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'miembros-create',
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
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'amigos',
                'subRutas' => [
                    'listaAmigos' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'lista amigos',
                        'route' => '/amigos',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAmigos' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'amigos create',
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
                'text' => 'donaciones',
                'icon' => 'bx bx-donate-heart',
                'subRutas' => [
                    'listaDonaciones' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'lista-donaciones',
                        'route' => '/donaciones',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearDonaciones' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'donaciones-create',
                        'route' => '/donaciones/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],
                ]
            ],

            'actividades' => [
                'controller' => actividadController::class,
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'text' => 'actividades',
                'icon' => 'bx bx-briefcase-alt',
                'subRutas' => [
                    'listaActividades' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'actividades',
                        'route' => '/actividades',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearActividades' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'actividades-create',
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
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'asitencias',
                'subRutas' => [
                    'listaAsistencias' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'listaAsistencias',
                        'route' => '/asistencias',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAsistencias' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'crearAsistencias',
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
                'text' => 'grupo familiares',
                'icon' => 'bx bx-group',
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'listaGrupoFamiliares',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearGrupoFamiliares' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'crearGrupoFamiliares',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarMiembro' => [
                        'text' => 'buscarMiembro',
                        'permisos' => permisos::$permiso,
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'parametros' => [],
                        'route' => '/grupo-familiares/buscar-miembro',
                        'method' => 'buscarMiembro',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'registrarGrupoFamiliar' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'registrarGrupoFamiliar',
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
                'text' => 'usuarios',
                'subRutas' => [
                    'listaUsuarios' => [
                        'permisos' => permisos::$usuarios,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'usuarios-lista',
                        'route' => '/usuarios',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearUsuarios' => [
                        'permisos' => permisos::$usuarios_crear,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'usuarios-create',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarUsuario' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'icon' => 'bx bx-bar-chart-alt-2',
                        'text' => 'buscarUsuario',
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
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'reportes',
                'controller' => reportesController::class,
                'icon' => 'bx bx-bar-chart-alt-2',
                'route' => '/reportes',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'Seguridad' => [
                'permisos' => permisos::$seguridad,
                'parametros' => [],
                'icon' => 'bx bx-bar-chart-alt-2',
                'text' => 'seguridad',
                'controller' => seguridadController::class,
                'route' => '/seguridad',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'Bitacora' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'controller' => bitacoreController::class,
                'icon' => 'bx bx-log-in-circle',
                'text' => 'lista',
                'route' => '/Bitacora',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'Ayuda' => [
                'controller' => ayudaController::class,
                'icon' => 'bx bx-chevron-down',
                'text' => 'lista',
                'route' => '/Ayuda',
                'method' => 'index',
                'action' => 'get',
                'permisos' => permisos::$permiso,
            ],

            'perfil' => [
                'permisos' => permisos::$permiso,
                'parametros' => [],
                'controller' => perfilController::class,
                'icon' => '',
                'text' => 'perfil',
                'subRutas' => [
                    'cuenta' => [
                        'permisos' => permisos::$permiso,
                        'parametros' => [],
                        'text' => 'cuenta',
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
                        'text' => 'preferencias',
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