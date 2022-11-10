<?php

namespace content\collections;

use Carbon\Carbon;
use content\models\notificacionModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class notificacionCollection
{
    public function formatNotificacion($notificaciones)
    {

        $dataNoti = [];
        $html = null;
        $cant = 0;

        foreach ($notificaciones as $notificacion) {
            $leidasUser = notificacionModel::leidas_user($notificacion['id']);
            if (is_null($leidasUser)) {
                $cant++;
                $notificacion['fecha_creada'] = Carbon::createFromFormat('Y-m-d H:i:s', $notificacion['fecha_creado'])->format('d/m/Y');
                $notificacion['route'] = '/notificaciones/vista/' . $notificacion['id'];
                $notificacion['fecha_creada'];
                $notificacion['mesanje'];
                $dataNoti[] = $notificacion;
            }
        }

        $data = [
            'notificaciones' => $dataNoti,
            'cantidad' => $cant
        ];
        return $data;
    }
}