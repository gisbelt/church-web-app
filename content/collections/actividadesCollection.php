<?php

namespace content\collections;

use content\core\exception\ForbiddenException;
use content\enums\permisos;
use DateTime;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class actividadesCollection
{
    public function formatActividades($actividades)
    {
        $data = [];
        foreach ($actividades as $actividad) {
            if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                $actividad['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                    '/actividades/editar/' . $actividad['id']
                );
            } else {
                $actividad['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            if (in_array(permisos::$eliminar_actividades_actividades, $_SESSION['user_permisos'])) {
                $actividad['actions'] .= sprintf(
                    '<button type="button"  name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                              </button>',
                );
            } else {
                $actividad['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            $date = $actividad['fecha'] . ' ' . $actividad['hora'];
            $date = new DateTime($date);
            $actividad['fecha'] = $date->format('d/m/Y H:i:s');
            $data[] = $actividad;
        }


        return $data;
    }
}