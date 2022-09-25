<?php

namespace content\collections;

class usuariosCollection
{
    public function formatUsuarios($usuarios)
    {
        $data = [];
        foreach ($usuarios as $usuario) {
            $usuario['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                '/usuarios/editar/' . $usuario['id'],
            );

            $usuario['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-usuario" id="eliminar-usuario" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/usuarios/eliminar/' . $usuario['id'],
            );
            $data[] = $usuario;
        }
        return $data;
    }
}