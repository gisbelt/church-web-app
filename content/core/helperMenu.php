<?php

namespace content\core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


/**
 *  Class helper menu
 *
 */
class helperMenu
{
    /**
     * Build menu
     *
     * @return null|string
     */
    public static function buildMenu()
    {
        $menu = rutas();
        return self::menuItems($menu);
    }

    /**
     * Menu items
     *
     * @param array|string $menu Menu items
     * @return null|string
     */
    private static function menuItems($menu)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $html = null;
        foreach ($menu as $key => $item) {
            if (!isset($item->permisos) || in_array($item->permisos, $_SESSION['user_permisos'])) {
                if(empty($item->subRutas)){
                    if (isset($item->route)) {
                        if (empty($item->parametros)) {
                            $route = $item->route;
                        } else {
                            $route = [$item->route, $item->parametros];
                        }
                        $route = is_null($item->route) ? 'javascript:void(0)' : $route;
                        $target = '_self';
                    }

                    $html .= sprintf(
                        '<li>'
                    );

                    $html .= sprintf(
                        '<div class="nav_link">',
                    );
                } else {
                    $html .= sprintf(
                        '<li>'
                    );

                    $html .= sprintf(
                        '<a class="nav_link">',
                    );
                }

                $html .= sprintf(
                    '<span class="nav_name center">',
                );
                $html .= sprintf(
                    '<i class="%s nav-ico"></i>',
                    $item->icon
                );
                $html .= '</span>';
                $html .= sprintf(
                    '<span class="nav_name center">%s</span>',
                    $item->text
                );

                $html .= '</a>';
            }
            $html .= self::menuItems($item->subRutas);

            $html .= '</li>';
        }
        return $html;
    }
}