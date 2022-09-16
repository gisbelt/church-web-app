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
use content\controllers\usuariosController;


if (!function_exists("routas")) {

    function rutas()
    {
        $rutas = [

            'login' => [
                'controller' => AutenticacionController::class,
                'subRutas' => [
                    'loginView' => [
                        'text' => 'index',
                        'route' => '/',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'loginPost' => [
                        'text' => 'login',
                        'route' => '/login',
                        'method' => 'iniciar',
                        'action' => 'post'
                    ],

                    'logout' => [
                        'text' => 'logout',
                        'route' => '/logout',
                        'method' => 'cerrarSesion',
                        'action' => 'get'
                    ],

                    'recuperarContrasena' => [
                        'text' => 'recuperar-contrasena',
                        'route' => '/recuperar-contrasena',
                        'method' => 'recuperarContrasena',
                        'action' => 'get'
                    ],
                ],
            ],

            'home' => [
                'controller' => homeController::class,
                'subRutas' => [
                    'homeView' => [
                        'text' => 'home',
                        'route' => '/home',
                        'method' => 'index',
                        'action' => 'get'
                    ]
                ]
            ],

            'miembros' => [
                'controller' => miembrosController::class,
                'subRutas' => [
                    'listaMiembros' => [
                        'text' => 'miembros',
                        'route' => '/miembros',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearMiembros' => [
                        'text' => 'miembros-create',
                        'route' => '/miembros/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'amigos' => [
                'controller' => amigosController::class,
                'subRutas' => [
                    'listaAmigos' => [
                        'text' => 'amigos',
                        'route' => '/amigos',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearAmigos' => [
                        'text' => 'amigos-create',
                        'route' => '/amigos/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'donaciones' => [
                'controller' => donacionesController::class,
                'subRutas' => [
                    'listaDonaciones' => [
                        'text' => 'donaciones',
                        'route' => '/donaciones',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearDonaciones' => [
                        'text' => 'donaciones-create',
                        'route' => '/donaciones/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'actividades' => [
                'controller' => actividadController::class,
                'subRutas' => [
                    'listaActividades' => [
                        'text' => 'actividades',
                        'route' => '/actividades',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearActividades' => [
                        'text' => 'actividades-create',
                        'route' => '/actividades/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'asitencias' => [
                'controller' => asistenciasController::class,
                'subRutas' => [
                    'listaAsitencias' => [
                        'text' => 'actividades-create',
                        'route' => '/asitencias',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearAsitencias' => [
                        'text' => 'actividades-create',
                        'route' => '/asitencias/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'grupoFamiliares' => [
                'controller' => grupoFamiliarController::class,
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'text' => 'grupos-create',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearGrupoFamiliares' => [
                        'text' => 'grupos-create',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'usuarios' => [
                'controller' => usuariosController::class,
                'subRutas' => [
                    'listaUsuarios' => [
                        'text' => 'usuarios-lista',
                        'route' => '/usuarios',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearUsuarios' => [
                        'text' => 'usuarios-create',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],
                ]
            ],

            'reportes' => [
                'text' => 'reportes',
                'controller' => reportesController::class,
                'route' => '/reportes',
                'method' => 'index',
                'action' => 'get'
            ],
            'Bitacora' => [
                'text' => 'bitacora',
                'controller' => reportesController::class,
                'route' => '/Bitacora',
                'method' => 'index',
                'action' => 'get'
            ],
        ];
        return json_decode(json_encode($rutas));
    }
}