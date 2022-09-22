<?php

namespace content\core;

use content\core\exception\ForbiddenException;
use content\core\Response;
use content\core\Request;
use content\core\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class Aplicacion
 *
 * @package content\core
 */
class Aplicacion
{
    public $layout = 'main';
    public static $ROOT_DIR;
    public $router;
    public $request;
    public $response;
    public static $app;
    public $controller;
    public $view;
    public $user = '';

    /**
     * Aplicacion constructor.
     *
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();


        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];;
        }
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    /**
     * Run router
     * @return void
     *
     */
    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $ex) {
            $this->response->setStatusCode($ex->getCode());
           echo $this->view->renderView('errorView', [
                'exception' => $ex
            ]);
        }
    }

    /**
     * @return \content\core\Controller
     */
    public function getController(): \content\core\Controller
    {
        return $this->controller;
    }

    /**
     * @param \content\core\Controller $controller
     */
    public function setController(\content\core\Controller $controller): void
    {
        $this->controller = $controller;
    }
}