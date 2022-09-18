<?php

namespace content\core;

use content\core\exception\ForbiddenException;
use content\core\exception\NotFoundException;
use content\core\Request;
use content\core\Response;

use content\enums\permisos;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class Router
 *
 * @package Content\core
 */
class Router
{
    public $request;
    public $response;
    protected $routes = [];

    /**
     * Router constructor.
     *
     * @param \app\core\Request $request
     * @param \app\core\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Function action get
     * @param $path
     * @param $callback
     * @return void
     *
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Function action post
     * @param $path
     * @param $callback
     * @return void
     *
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     *  Resolve url requests
     * @throws NotFoundException
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Aplicacion::$app->view->renderView($callback);
        }
        if (is_array($callback)) {
            /** @var \content\core\Controller $controller */
            $controller = new $callback[0]();
            Aplicacion::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request);
    }
}