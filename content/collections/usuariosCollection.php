<?php

namespace content\collections;

class usuariosCollection
{
    public function formatUsuarios($usuarios)
    {
        $data = [];
        foreach ($usuarios as $usuario) {
            $usuario['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>',
                '/usuarios/editar/' . $usuario['id'],
            );

            if ($usuario['status'] == 1) {
                $usuario['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-usuario" id="eliminar-usuario" class="btn btn-danger ms-2" data-title="eliminar"><i class="bi bi-trash text-light"></i>
                          </button>',
                    '/usuarios/eliminar/' . $usuario['id'],
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