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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'login',
                'subRutas' => [
                    'loginView' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'index',
                        'route' => '/',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'loginPost' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'login',
                        'route' => '/login',
                        'method' => 'iniciar',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'logout' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'logout',
                        'route' => '/logout',
                        'method' => 'cerrarSesion',
                        'action' => 'get'
                    ],

                    'recuperarContrasena' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'recuperar-contrasena',
                        'route' => '/recuperar-contrasena',
                        'method' => 'recuperarContrasena',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'cambiarContrasena' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'icon' => '',
                'text' => 'home',
                'subRutas' => [
                    'homeView' => [
                        'permisos' => permisos::$home,
                        'parametros' => [],
                        'text' => 'home',
                        'icon' => '',
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
                'icon' => '',
                'permisos' => null,
                'text' => 'error',
                'subRutas' => [
                    'errorView' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'miembros',
                'subRutas' => [
                    'listaMiembros' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'lista-miembros',
                        'route' => '/miembros',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearMiembros' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'amigos',
                'subRutas' => [
                    'listaAmigos' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'lista amigos',
                        'route' => '/amigos',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAmigos' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'donaciones',
                'subRutas' => [
                    'listaDonaciones' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'lista-donaciones',
                        'route' => '/donaciones',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearDonaciones' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'actividades',
                'subRutas' => [
                    'listaActividades' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'actividades',
                        'route' => '/actividades',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearActividades' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'asitencias',
                'subRutas' => [
                    'listaAsistencias' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'listaAsistencias',
                        'route' => '/asistencias',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearAsistencias' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'grupo familiares',
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'permisos' => null,
                        'parametros' => [],
                        'text' => 'listaGrupoFamiliares',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearGrupoFamiliares' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'crearGrupoFamiliares',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarMiembro' => [
                        'text' => 'buscarMiembro',
                        'permisos' => null,
                        'icon' => '',
                        'parametros' => [],
                        'route' => '/grupo-familiares/buscar-miembro',
                        'method' => 'buscarMiembro',
                        'action' => 'post',
                        'subRutas' => []
                    ],

                    'registrarGrupoFamiliar' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
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
                'permisos' => permisos::$usuarios,
                'parametros' => [],
                'icon' => 'bx bx-user',
                'text' => 'usuarios',
                'subRutas' => [
                    'listaUsuarios' => [
                        'permisos' => permisos::$usuarios,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'usuarios-lista',
                        'route' => '/usuarios',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'crearUsuarios' => [
                        'permisos' => permisos::$usuarios_crear,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'usuarios-create',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'buscarUsuario' => [
                        'permisos' => null,
                        'parametros' => [],
                        'icon' => '',
                        'text' => 'buscarUsuario',
                        'route' => '/usuarios/buscar-usuario',
                        'method' => 'buscarUsuario',
                        'action' => 'post',
                        'subRutas' => []
                    ],
                ]
            ],

            'reportes' => [
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'reportes',
                'controller' => reportesController::class,
                'route' => '/reportes',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'Seguridad' => [
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'text' => 'seguridad',
                'controller' => seguridadController::class,
                'route' => '/seguridad',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'Bitacora' => [
                'permisos' => null,
                'parametros' => [],
                'icon' => '',
                'controller' => bitacoreController::class,
                'text' => 'lista',
                'icon' => '',
                'route' => '/Bitacora',
                'method' => 'index',
                'action' => 'get',
                'subRutas' => []
            ],

            'perfil' => [
                'permisos' => null,
                'parametros' => [],
                'controller' => perfilController::class,
                'icon' => '',
                'text' => 'perfil',
                'subRutas' => [
                    'cuenta' => [
                        'permisos' => null,
                        'parametros' => [],
                        'text' => 'cuenta',
                        'icon' => '',
                        'route' => '/cuenta',
                        'method' => 'index',
                        'action' => 'get',
                        'subRutas' => []
                    ],

                    'preferencias' => [
                        'permisos' => null,
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