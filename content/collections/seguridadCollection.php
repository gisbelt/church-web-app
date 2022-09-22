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
        foreach ($permisos as $permiso) {
            $permiso['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
               '/seguridad/editar/' . $permiso['permiso'],
            );

            $permiso['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-permiso" id="eliminar-permiso" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/seguridad/eliminar/' . $permiso['permiso'],
            );
            $data[] = $permiso;
        }
        return $data;
    }
}