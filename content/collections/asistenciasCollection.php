<?php

namespace content\collections;

use content\enums\permisos;

/**
 * Class seguridad Collection
 *
 */
class asistenciasCollection
{
    public function formatAsistencias($asistencias)
    {
        $data = [];
        foreach ($asistencias as $asistencia) {
            if (in_array(permisos::$actualizar_asitencias, $_SESSION['user_permisos'])) {
                $asistencia['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info mx-2" target="_blank" title="editar"><i class="bi bi-pencil text-light"></i></a>',
                    '/asistencias/editar/' . $asistencia['asistencia'],
                );
            } else {
                $asistencia['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            if (in_array(permisos::$eliminar_asitencias_asitencias, $_SESSION['user_permisos'])) {
                $asistencia['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-asistencia" id="eliminar-asistencia" class="btn btn-danger mx-2" title="eliminar"><i class="bi bi-trash text-light"></i>
                          </button>',
                    '/asistencias/eliminar/' . $asistencia['asistencia'],
                );
            } else {
                $asistencia['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            $data[] = $asistencia;
        }
        return $data;
    }

}