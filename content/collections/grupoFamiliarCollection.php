<?php

namespace content\collections;

use content\enums\permisos;

/**
 * Class seguridad Collection
 *
 */
class grupoFamiliarCollection
{
    public function formatAmigosLista($amigos)
    {
        $data = [];
        foreach ($amigos as $amigo) {
            $amigo['actions'] = sprintf(
                '<a data-id="%s" class="btn btn-warning add-amigo-lista" value="" data-bs-dismiss="modal"> <i class="bi bi-plus-circle"></i> </a>',
                $amigo['amigo']
            );
            $data[] = $amigo;
        }
        return $data;
    }

    public function formatGrupos($grupos)
    {
        $data = [];
        foreach ($grupos as $grupo) {
            if (in_array(permisos::$actualizar_grupo_familiar, $_SESSION['user_permisos'])) {
                $grupo['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info mx-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>',
                    '/grupo-familiares/editar/' . $grupo['grupo'],
                );
            } else {
                $grupo['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }

            if (in_array(permisos::$eliminar_grupo_familiar, $_SESSION['user_permisos'])) {
                $grupo['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-grupo" id="eliminar-grupo" class="btn btn-danger mx-2" data-title="eliminar"><i class="bi bi-trash text-light"></i>
                              </button>',
                    '/grupo-familiares/eliminar/' . $grupo['grupo'],
                );
            } else {
                $grupo['actions'] = sprintf(
                    '<h5><span class="badge bg-%s">%s</span></h5>',
                    'warning',
                    'Accion no disponible'
                );
            }
            $grupo['actions'] .= sprintf(
                '<button name="grupo-modal" data-id="%s" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#integrantes" data-title="ver amigos">
                 <i class="bi bi-eye text-light">%s</i>
                </button>',
                $grupo['grupo'],
                'Ver Integrantes'
            );
            $data[] = $grupo;
        }
        return $data;
    }

    public function formatObservarAmigos($amigos)
    {
        $data = [];
        foreach ($amigos as $amigo) {
            $amigo['actions'] = sprintf(
                '<button type="button" data-route="%s" name="eliminar-amigo-grupo" id="eliminar-amigo-grupo" class="btn btn-danger mx-2" data-title="eliminar"><i class="bi bi-trash text-light"></i>
                          </button>',
                '/grupo-familiares/eliminar-amigo/' . $amigo['amigo'] . '/' . $amigo['grupo_id'],
            );
            $data[] = $amigo;
        }
        return $data;
    }

    //Reportes
    public function formatGruposReport($grupos)
    {
        $data = [];
        foreach($grupos as $grupo)
        {
            switch ($grupo['mes']){
                case 1:
                    $grupo['mes'] = 'Enero';
                    break;
                case 2:
                    $grupo['mes'] = 'Febrero';
                    break;
                case 3:
                    $grupo['mes'] = 'Marzo';
                    break;
                case 4:
                    $grupo['mes'] = 'Abril';
                    break;
                case 5:
                    $grupo['mes'] = 'Mayo';
                    break;
                case 6:
                    $grupo['mes'] = 'Junio';
                    break;    
                case 7:
                    $grupo['mes'] = 'Julio';
                    break;
                case 8:
                    $grupo['mes'] = 'Agosto';
                    break;
                case 9:
                    $grupo['mes'] = 'Septiembre';
                    break;
                case 10:
                    $grupo['mes'] = 'Octubre';
                    break;
                case 11:
                    $grupo['mes'] = 'Noviembre';
                    break;
                case 12:
                    $grupo['mes'] = 'Diciembre';
                    break;
                default:{
                    $grupo['mes'] = 'No Disponible';
                }
            }
            $data[] = $grupo;
        }
        return $data;
    }
}