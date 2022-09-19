<?php

namespace content\collections;

/**
 * Class seguridad Collection
 *
 */
class seguridadCollection
{
    public function formatPermisos($permisos)
    {
        $data = [];
        foreach ($permisos as $permiso)
        {
            $permiso['actions'] = sprintf(
                '<a href="/seguridad/crear" name="seleccionar" id="seleccionar" class="btn btn-info me-2 seleccionar">
                            <i class="bi bi-pencil text-light"></i></a>'
            );

            $permiso['actions'] .= sprintf(
                '<a href="/seguridad/crear" name="borrar" id="borrar" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </a>'
            );
            $data[] = $permiso;
        }
        return $data;
    }
}