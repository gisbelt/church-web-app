<?php

namespace content\controllers;

use content\core\Controller;
use content\core\exception\ForbiddenException;
use content\core\middlewares\AutenticacionMiddleware;
use content\enums\permisos;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class bitacoraController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
    }

    public function index()
    {
        if (!in_array(permisos::$bitacora, $_SESSION['user_permisos'])) {
            throw new ForbiddenException();
        }
        $data['titulo'] = 'Bitacora';
        return new RedirectResponse('/home', 302);

    }
}