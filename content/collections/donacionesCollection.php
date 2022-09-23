<?php

namespace content\collections;

/**
 * Class seguridad Collection
 *
 */
class donacionesCollection
{
    public function formatDonaciones($donaciones)
    {
        $data = [];
        foreach ($donaciones as $donacion) {
            $donacion['actions'] = sprintf(
                '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                '/donaciones/editar/' . $donacion['donacion'],
            );

            $donacion['actions'] .= sprintf(
                '<button type="button" data-route="%s" name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/donaciones/eliminar/' . $donacion['donacion'],
            );

            if($donacion['disponible']){
                $donacion['actions'] .= sprintf(
                    '<button name="donacion-modal" data-donacion="%s" class="btn btn-success ms-2" data-bs-toggle="modal"
                                            data-bs-target="#observacion_donacion"><i class="bi bi-save text-light"> %s</i>
                          </button>',
                    $donacion['donacion'],
                    'Agregar observacion'
                );
            }

            $statusClass = $donacion['disponible'] == 1 ? 'success' : 'warning';
            $statusText = $donacion['disponible'] == 1 ? 'Disponible' : 'Agotado';
            $donacion['disponible'] = sprintf(
                '<h5><span class="badge bg-%s">%s</span></h5>',
                $statusClass,
                $statusText
            );
            $data[] = $donacion;
        }
        return $data;
    }

}