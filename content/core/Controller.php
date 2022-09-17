<?php

namespace content\core;

use content\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @package content\core
 */
class Controller
{
    public $layout = 'main';
    public $action = '';
    /**
     * @var BaseMiddleware[]
     */
    protected $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Aplicacion::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}