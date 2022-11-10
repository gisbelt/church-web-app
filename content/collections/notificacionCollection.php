<?php

namespace content\collections;

use Carbon\Carbon;

class notificacionCollection
{
    public function formatNotificacion($notificaciones)
    {
        $dataNoti = [];
        $html = null;
        $cant = 0;
        foreach ($notificaciones as $notificacion) {
            $cant++;
            $notificacion['fecha_creada'] = Carbon::createFromFormat('Y-m-d H:i:s', $notificacion['fecha_creado'])->format('d/m/Y');
            $notificacion['route'] =  '/notificaciones/vista/' . $notificacion['id'];
            $notificacion['fecha_creada'];
            $notificacion['mesanje'];
            $dataNoti[] = $notificacion;
        }
        $data = [
            'notificaciones' => $dataNoti,
            'cantidad' => $cant
        ];
        return $data;
    }
}