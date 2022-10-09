<?php

namespace content\controllers;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
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
        $data['titulo'] = 'Bitacora';
        return new RedirectResponse('/home', 302);

    }
}