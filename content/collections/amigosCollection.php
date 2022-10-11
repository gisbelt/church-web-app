<?php

namespace content\collections;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosCollection
{
    public function formatAmigos($amigos)
    {
        $data = [];
        foreach ($amigos as $amigo) {
            if ($amigo['status'] == 1) {
                $amigo['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>',
                    '/amigos/editar/' . $amigo['amigo'],
                );

                $amigo['actions'] .= sprintf(
                    '<button name="miembro-modal" data-amigo="%s" class="btn btn-success mx-2" data-bs-toggle="modal"
                                data-bs-target="#convertir-miembro-modal"><i class="bi bi-arrow-clockwise text-light"></i> %s</button>',
                    $amigo['amigo'],
                    'Convertir a miembro'
                );
            } else {
                $amigo['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                   'Accion no disponible'
                );
            }

            $amigo['telefono'] = !is_null($amigo['telefono']) ? $amigo['telefono'] : 'No tiene telefono';
            if ($amigo['sexo'] == '1') {
                $amigo['sexo'] = 'Masculino';
            } else if ($amigo['sexo'] == '0') {
                $amigo['sexo'] = 'Femenino';
            }

            $statusClass = $amigo['status'] == 1 ? 'success' : 'warning';
            $statusText = $amigo['status'] == 1 ? 'Es amigo' : 'Ahora es miembro';
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