<?php

namespace content\collections;

use content\enums\permisos;

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
            if (in_array(permisos::$actualizar_donacion, $_SESSION['user_permisos'])) {
                $donacion['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info mx-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                    '/donaciones/editar/' . $donacion['donacion'],
                );
            } else {
                $donacion['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            if (in_array(permisos::$eliminar_donacion, $_SESSION['user_permisos'])) {
                if ($donacion['status'] == 1) {
                    $donacion['actions'] .= sprintf(
                        '<button type="button" data-route="%s" name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger mx-2"><i class="bi bi-trash text-light"></i>
                                  </button>',
                        '/donaciones/eliminar/' . $donacion['donacion'],
                    );
                }
            } else {
                $donacion['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            if (in_array(permisos::$obseravacion_donacion, $_SESSION['user_permisos'])) {
                if ($donacion['disponible']) {
                    $donacion['actions'] .= sprintf(
                        '<button name="donacion-modal" data-donacion="%s" class="btn btn-success mx-2" data-bs-toggle="modal"
                                                data-bs-target="#observacion_donacion"><i class="bi bi-save text-light"> %s</i>
                              </button>',
                        $donacion['donacion'],
                        'Agregar observacion'
                    );
                } else {
                    $donacion['actions'] = sprintf(
                        '<h5><span class="badge bg-%s">%s</span></h5>',
                        'warning',
                        'Accion no disponible'
                    );
                }
            } else {
                $donacion['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
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