<?php

namespace content\collections;

class miembrosCollection
{
    public function formatMiembros($miembros)
    {
        $data = [];
        foreach ($miembros as $miembro) {
            $miembro['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                '/miembros/editar/' . $miembro['id'],
            );

            if ($miembro['status'] == 1) {
                $miembro['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-miembro" id="eliminar-miembro" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                    '/miembros/eliminar/' . $miembro['id'],
                );
            }
            $miembro['telefono'] = !is_null($miembro['telefono']) ? $miembro['telefono'] : 'No tiene telefono';
            $miembro['fecha_bautismo'] = !is_null($miembro['fecha_bautismo']) ? $miembro['fecha_bautismo'] : 'No se ha bautizado';
            $miembro['fecha_fe'] = !is_null($miembro['fecha_fe']) ? $miembro['fecha_fe'] : 'Sin registro de fecha';
            $statusClass = $miembro['status'] == 1 ? 'success' : 'warning';
            $statusText = $miembro['status'] == 1 ? 'Activo' : 'Inactivo';
            $miembro['status'] = sprintf(
                '<h5><span class="badge bg-%s">%s</span></h5>',
                $statusClass,
                $statusText
            );
            $data[] = $miembro;
        }
        return $data;
    }
}