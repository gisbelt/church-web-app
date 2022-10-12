<?php

namespace content\collections;

use content\enums\permisos;

class usuariosCollection
{
    public function formatUsuarios($usuarios)
    {
        $data = [];
        foreach ($usuarios as $usuario) {
            if (in_array(permisos::$actualizar_usuarios, $_SESSION['user_permisos'])) {
                $usuario['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>',
                    '/usuarios/editar/' . $usuario['id'],
                );
            } else {
                $usuario['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }

            if ($usuario['status'] == 1) {
                if (in_array(permisos::$eliminar_usuarios, $_SESSION['user_permisos'])) {
                    $usuario['actions'] .= sprintf(
                        '<button type="button" data-route="%s" name="eliminar-usuario" id="eliminar-usuario" class="btn btn-danger ms-2" data-title="eliminar"><i class="bi bi-trash text-light"></i>
                          </button>',
                        '/usuarios/eliminar/' . $usuario['id'],
                    );
                } else {
                    $usuario['actions'] = sprintf(
                        '<h5><span class="badge bg-%s">%s</span></h5>',
                        'warning',
                        'Accion no disponible'
                    );
                }
            } else {
                $usuario['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            $statusClass = $usuario['status'] == 1 ? 'success' : 'warning';
            $statusText = $usuario['status'] == 1 ? 'Activo' : 'Inactivo';
            $usuario['status'] = sprintf(
                '<h5><span class="badge bg-%s">%s</span></h5>',
                $statusClass,
                $statusText
            );
            $data[] = $usuario;
        }
        return $data;
    }
}