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
            if ($key !== 'login' && $key !== 'home' && $key !== 'error' && $key !== 'perfil') {
                if (!isset($item->permisos) || in_array($item->permisos, $_SESSION['user_permisos'])) {
                    if (empty($item->subRutas)) {
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
                            '<a class="nav_link" data-number="%s" href="%s">',
                            $key,
                            $route
                        );

                    } else {
                        $html .= sprintf(
                            '<li>'
                        );

                        $html .= sprintf(
                            '<a class="nav_link" data-number="%s">',
                            $key
                        );
                    }

                    $html .= sprintf(
                        '<i class="%s nav-ico"></i>',
                        $item->icon
                    );
                    if (!empty($item->subRutas)) {
                        $html .= sprintf(
                            '<span class="nav_name center">%s <i class="bx bx-chevron-down nav_dropdown_icon dropdown_icon_%s" data-number="%s"></i></span>',
                            $item->text,
                            $key,
                            $key
                        );
                    } else {
                        $html .= sprintf(
                            '<span class="nav_name">%s</span>',
                            $item->text,
                        );
                    }
                    $html .= '</span>';
                    $html .= '</a>';

                    if (!empty($item->subRutas)) {
                        $html .= sprintf(
                            '<ul class="hidden item_show_%s itemShow">',
                            $key
                        );
                        $html .= self::menuItems($item->subRutas);
                        $html .= '</ul>';
                    }
                    $html .= '</a>';
                    $html .= '</li>';
                }
            }
        }
        return $html;
    }
}