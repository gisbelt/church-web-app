<?php

namespace content\collections;

use Carbon\Carbon;

class notificacionCollection
{
    public function formatNotificacion($notificaciones)
    {
        $data = [];
        $html = null;
        foreach ($notificaciones as $notificacion) {
            $notificacion['fecha_creada'] = Carbon::createFromFormat('Y-m-d H:i:s', $notificacion['fecha_creado'])->format('d/m/Y');
            $notificacion['route'] =  '/notificaciones/vista/' . $notificacion['id'];
            $notificacion['fecha_creada'];
            $notificacion['mesanje'];
            $data[] = $notificacion;
        }
        return $data;
    }
}