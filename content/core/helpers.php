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
use content\controllers\perfilController;
use content\controllers\errorController;


if (!function_exists("routas")) {

    function rutas()
    {
        $rutas = [
            'login' => [
                'controller' => AutenticacionController::class,
                'subRutas' => [
                    'loginView' => [
                        'text' => '',
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

            'error' => [
                'controller' => errorController::class,
                'subRutas' => [
                    'errorView' => [
                        'text' => 'error',
                        'route' => '/error',
                        'method' => 'index'
                    ]
                ]
            ],

            'miembros' => [
                'controller' => miembrosController::class,
                'subRutas' => [
                    'listaMiembros' => [
                        'text' => 'listaMiembros',
                        'route' => '/miembros',
                        'method' => 'index'
                    ],

                    'crearMiembros' => [
                        'text' => 'crearMiembros',
                        'route' => '/miembros/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'amigos' => [
                'controller' => amigosController::class,
                'subRutas' => [
                    'listaAmigos' => [
                        'text' => 'listaAmigos',
                        'route' => '/amigos',
                        'method' => 'index',
                    ],

                    'crearAmigos' => [
                        'text' => 'crearAmigos',
                        'route' => '/amigos/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'donaciones' => [
                'controller' => donacionesController::class,
                'subRutas' => [
                    'listaDonaciones' => [
                        'text' => 'listaDonaciones',
                        'route' => '/donaciones',
                        'method' => 'index'
                    ],

                    'crearDonaciones' => [
                        'text' => 'crearDonaciones',
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
                        'route' => '/asitencias',
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
                        'text' => 'listaGrupoFamiliares',
                        'route' => '/grupo-familiares',
                        'method' => 'index',
                    ],

                    'crearGrupoFamiliares' => [
                        'text' => 'crearGrupoFamiliares',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'usuarios' => [
                'controller' => usuariosController::class,
                'subRutas' => [
                    'listaUsuarios' => [
                        'text' => 'usuarios',
                        'route' => '/usuarios',
                        'method' => 'index',
                    ],

                    'crearUsuarios' => [
                        'text' => 'registrar',
                        'route' => '/usuarios/create',
                        'method' => 'create',
                    ],
                ]
            ],

            'reportes' => [
                'controller' => reportesController::class,
                'text' => 'reportes',
                'route' => '/reportes',
                'method' => 'index',
            ],

            'Bitacora' => [
                'controller' => bitacoreController::class,
                'text' => 'lista',
                'route' => '/Bitacora',
                'method' => 'index',
            ],

            'perfil' => [
                'controller' => perfilController::class,
                'subRutas' => [
                    'cuenta' => [
                        'text' => 'cuenta',
                        'route' => '/cuenta',
                        'method' => 'index',
                    ],

                    'preferencias' => [
                        'text' => 'preferencias',
                        'route' => '/preferencias',
                        'method' => 'preferencias',
                    ],
                ]
            ],
        ];
        return json_decode(json_encode($rutas));
    }
}