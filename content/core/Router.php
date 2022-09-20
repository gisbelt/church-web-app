<?php

namespace content\core;

use content\core\exception\NotFoundException;

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
    protected $routeMap = [];

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
        $this->routeMap['get'][$path] = $callback;
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
        $this->routeMap['post'][$path] = $callback;
    }


    public function getRouteMap($method)
    {
        return $this->routeMap[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $url = trim($url, '/');

        $routes = $this->getRouteMap($method);

        $routeParams = false;
        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', function ($m) {
                    return isset($m[2]) ? "({$m[2]})" : '(\w+)';
                }, $route) . "$@";

            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);
                $this->request->setRouteParams($routeParams);
                return $callback;
            }
        }
        return false;
    }

    /**
     *  Resolve url requests
     * @throws NotFoundException
     */
    public function resolve()
    {
        $path = $this->request->getUrl();
        $method = $this->request->getMethod();
        $callback = $this->routeMap[$method][$path] ?? false;

        if (!$callback) {
            $callback = $this->getCallback();
            if ($callback === false) {
                $this->response->setStatusCode(404);
                throw new NotFoundException();
            }
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
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request);
    }
}