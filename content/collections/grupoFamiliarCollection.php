<?php

namespace content\collections;

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
                '<a id="add" data-id="%s" class="btn btn-warning addLista" value="" data-bs-dismiss="modal"> <i class="bi bi-plus-circle"></i> </a>',
                $amigo['amigo']
            );
            $data[] = $amigo;
        }
        return $data;
    }
}