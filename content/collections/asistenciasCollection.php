<?php

namespace content\collections;

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
            $asistencia['actions'] = sprintf(
                '<a href="%s" class="btn btn-info mx-2" target="_blank" title="editar"><i class="bi bi-pencil text-light"></i></a>',
                '/asistencias/editar/' . $asistencia['asistencia'],
            );

            $asistencia['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-asistencia" id="eliminar-asistencia" class="btn btn-danger mx-2" title="eliminar"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/asistencias/eliminar/' . $asistencia['asistencia'],
            );

            $data[] = $asistencia;
        }
        return $data;
    }

}