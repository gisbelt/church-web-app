<?php

namespace content\core\middlewares;

use content\core\Aplicacion;
use content\core\exception\ForbiddenException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 *  Class BaseMiddleware
 *
 * @package content\core\middlewares
 */
class AutenticacionMiddleware extends BaseMiddleware
{
    protected $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [in_array(Aplicacion::$app->controller->action, $this->actions)]);
        if (Aplicacion::isGuest()) {
            if (empty($this->actions) || in_array(Aplicacion::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        } else if(!in_array(Aplicacion::$app->controller->action, $this->actions)){
            throw new ForbiddenException();
        }
    }

}