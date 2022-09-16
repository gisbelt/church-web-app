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

                    'cambiarContrasena' => [
                        'text' => 'cambiar-contrasena',
                        'route' => '/cambiar-contrasena',
                        'method' => 'cambiarContrasena',
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

            'error' => [
                'controller' => errorController::class,
                'subRutas' => [
                    'errorView' => [
                        'text' => 'error',
                        'route' => '/error',
                        'method' => 'index',
                        'action' => 'get'
                    ]
                ]
            ],

            'miembros' => [
                'controller' => miembrosController::class,
                'subRutas' => [
                    'listaMiembros' => [
                        'text' => 'lista-miembros',
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
                        'text' => 'lista-amigos',
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
                        'text' => 'lista-donaciones',
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
                    'listaAsistencias' => [
                        'text' => 'listaAsistencias',
                        'route' => '/asistencias',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'crearAsistencias' => [
                        'text' => 'crearAsistencias',
                        'route' => '/asistencias/create',
                        'method' => 'create',
                        'action' => 'get',
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
                        'action' => 'get'
                    ],

                    'crearGrupoFamiliares' => [
                        'text' => 'crearGrupoFamiliares',
                        'route' => '/grupo-familiares/create',
                        'method' => 'create',
                        'action' => 'get'
                    ],

                    'buscarMiembro' => [
                        'text' => 'buscarMiembro',
                        'route' => '/grupo-familiares/buscar-miembro',
                        'method' => 'buscarMiembro',
                        'action' => 'get'
                    ],

                    'registrarGrupoFamiliar' => [
                        'text' => 'registrarGrupoFamiliar',
                        'route' => '/grupo-familiares/registrar-grupoFamiliar',
                        'method' => 'registrarGrupoFamiliar',
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

                    'buscarUsuario' => [
                        'text' => 'buscarUsuario',
                        'route' => '/usuarios/buscar-usuario',
                        'method' => 'buscarUsuario',
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
                'controller' => bitacoreController::class,
                'text' => 'lista',
                'route' => '/Bitacora',
                'method' => 'index',
                'action' => 'get'
            ],

            'perfil' => [
                'controller' => perfilController::class,
                'subRutas' => [
                    'cuenta' => [
                        'text' => 'cuenta',
                        'route' => '/cuenta',
                        'method' => 'index',
                        'action' => 'get'
                    ],

                    'preferencias' => [
                        'text' => 'preferencias',
                        'route' => '/preferencias',
                        'method' => 'preferencias',
                        'action' => 'get'
                    ],
                ]
            ],
        ];
        return json_decode(json_encode($rutas));
    }
}