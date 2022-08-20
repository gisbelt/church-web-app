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
use  \content\controllers\reportesController;

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
                    ],

                    'loginPost' => [
                        'text' => 'login',
                        'route' => '/login',
                        'method' => 'iniciar',
                    ],

                    'logout' => [
                        'text' => 'logout',
                        'route' => '/logout',
                        'method' => 'cerrarSesion',
                    ],

                    'recuperarContrasena' => [
                        'text' => 'recuperar-contrasena',
                        'route' => '/recuperar-contrasena',
                        'method' => 'recuperarContrasena',
                    ],
                ],
            ],


            'home' => [
                'controller' => homeController::class,
                'subRutas' => [
                    'homeView' => [
                        'text' => 'home',
                        'route' => '/home',
                        'method' => 'index'
                    ]
                ]
            ],

            'miembros' => [
                'controller' => miembrosController::class,
                'subRutas' => [
                    'listaMiembros' => [
                        'text' => 'lista',
                        'route' => '/miembros',
                        'method' => 'index'
                    ],

                    'crearMiembros' => [
                        'text' => 'registrar',
                        'route' => '/miembros/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'amigos' => [
                'controller' => amigosController::class,
                'subRutas' => [
                    'listaAmigos' => [
                        'text' => 'lista',
                        'route' => '/amigos',
                        'method' => 'index',
                    ],

                    'crearAmigos' => [
                        'text' => 'registrar',
                        'route' => '/amigos/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'donaciones' => [
                'controller' => donacionesController::class,
                'subRutas' => [
                    'listaDonaciones' => [
                        'text' => 'lista',
                        'route' => '/donaciones',
                        'method' => 'index'
                    ],

                    'crearDonaciones' => [
                        'text' => 'registrar',
                        'route' => '/donaciones/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'actividades' => [
                'controller' => actividadController::class,
                'subRutas' => [
                    'listaActividades' => [
                        'text' => 'ista',
                        'route' => '/actividades',
                        'method' => 'index',
                    ],

                    'crearActividades' => [
                        'text' => 'registrar',
                        'route' => '/actividades/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'asitencias' => [
                'controller' => asistenciasController::class,
                'subRutas' => [
                    'listaAsitencias' => [
                        'text' => 'lista',
                        'route' => '/asitencias/',
                        'method' => 'index',
                    ],

                    'crearAsitencias' => [
                        'text' => 'Registrar',
                        'route' => '/asitencias/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'grupoFamiliares' => [
                'controller' => grupoFamiliarController::class,
                'subRutas' => [
                    'listaGrupoFamiliares' => [
                        'text' => 'lista',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                    ],

                    'crearGrupoFamiliares' => [
                        'text' => 'registrar',
                        'route' => 'grupo-familiares/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'reportes' => [
                'controller' => reportesController::class,
                'text' => 'lista',
                'route' => '/reportes',
                'method' => 'index',
            ],
            'Bitacora' => [
                'controller' => reportesController::class,
                'text' => 'lista',
                'route' => '/Bitacora',
                'method' => 'index',
            ],
        ];
        return json_decode(json_encode($rutas));
    }
}