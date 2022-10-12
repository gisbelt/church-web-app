<?php

namespace content\collections;

use content\core\exception\ForbiddenException;
use content\enums\estadosActividad as status;
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
            switch ($actividad['status']) {
                case status::$en_curso:
                    $actividad['status'] = 'En Curso';
                    break;
                case status::$en_pausa:
                    $actividad['status'] = 'En Pausa';
                    break;
                case status::$terminado:
                    $actividad['status'] = 'Terminado';
                    break;
                case status::$cancelado:
                    $actividad['status'] = 'Cancelado';
                    break;
                default:
                {
                    $actividad['status'] = 'No Disponible';
                }
            }
        }
    }

    public function formatActividades2($actividades)
    {
        $data = [];
        foreach ($actividades as $actividad) {
            if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                $actividad['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>',
                    '/actividades/editar/' . $actividad['id']
                );
            } else {
                $actividad['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            if (in_array(permisos::$eliminar_actividades, $_SESSION['user_permisos'])) {
                $actividad['actions'] .= sprintf(
                    '<button type="button"  name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger ms-2" data-title="eliminar"><i class="bi bi-trash text-light"></i>
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