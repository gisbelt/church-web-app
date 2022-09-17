<?php

namespace content\core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class view
 *
 * @package \content\core
 */
class View
{
    public $title = '';

    /**
     *  Render view
     * @param $view
     * @param $data
     * @return array|false|string|string[]
     */
    public function renderView($view, $data = [])
    {
        $viewContent = $this->renderOnlyView($view, $data);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Layout content
     * @return false|string
     */
    protected function layoutContent()
    {
        if (isset($_SESSION['email'])){
            $layout = Aplicacion::$app->layout;
            if (Aplicacion::$app->controller) {
                $layout = Aplicacion::$app->controller->layout;
            }
        } else {
            $layout = 'auth';
        }

        ob_start();
        include_once Aplicacion::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * Render only view
     *
     * @param $view
     * @param $data
     * @return false|string
     */
    protected function renderOnlyView($view, $data)
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Aplicacion::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}