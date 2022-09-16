<?php

namespace content\core\middlewares;

use content\core\Aplicacion;
use content\core\exception\ForbiddenException;

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
        if (Aplicacion::isGuest()) {
            if (empty($this->actions) || in_array(Aplicacion::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }

}