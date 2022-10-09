<?php

namespace content\collections;

class amigosCollection
{
    public function formatAmigos($amigos)
    {
        $data = [];
        foreach ($amigos as $amigo) {
            $amigo['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                '/amigos/editar/' . $amigo['id'],
            );

            if($amigo['status'] == 1){
                $amigo['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-amigos" id="eliminar-amigos" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                    '/amigos/eliminar/' . $amigo['id'],
                );
            }

            $amigo['telefono'] = !is_null($amigo['telefono']) ? $amigo['telefono'] : 'No tiene telefono';
            if ($amigo['sexo'] == 1){
                $amigo['sexo'] = 'Masculino';
            } else if($amigo['sexo'] == 0) {
                $amigo['sexo'] = 'Femenino';
            }

            $statusClass = $amigo['status'] == 1 ? 'success' : 'warning';
            $statusText = $amigo['status'] == 1 ? 'Activo' : 'Inactivo';
            $amigo['status'] = sprintf(
                '<h5><span class="badge bg-%s">%s</span></h5>',
                $statusClass,
                $statusText
            );
            $data[] = $amigo;
        }
        return $data;
    }
}