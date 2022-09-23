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
               '/seguridad/permisos/editar/' . $permiso['permiso'],
            );

            $permiso['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-permiso" id="eliminar-permiso" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/seguridad/permisos/eliminar/' . $permiso['permiso'],
            );
            $data[] = $permiso;
        }
        return $data;
    }

    public function formatRoles($roles)
    {
        $data = [];
        foreach ($roles as $role) {
            $role['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                '/seguridad/roles/editar/' . $role['rol'],
            );

            $role['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-rol" id="eliminar-rol" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/seguridad/roles/eliminar/' . $role['rol'],
            );
            $data[] = $role;
        }
        return $data;
    }
}