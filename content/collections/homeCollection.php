<?php

namespace content\collections;

use DateTime;

class homeCollection
{
    public function formatActividades($actividades)
    {
        $data = [];
        foreach ($actividades as $actividad) {
            $date = $actividad['fecha'] . ' ' . $actividad['hora'];
            $date = new DateTime($date);
            $actividad['fecha'] = $date->format('d/m/Y H:i:s');
            $data[] = $actividad;
        }
        return $data;
    }

    public function formatBitacora($bitacoras)
    {
        $data = [];
        foreach ($bitacoras as $bitacora) {
            $date = $bitacora['fecha'];
            $date = new DateTime($date);
            $bitacora['fecha'] = $date->format('d/m/Y H:i:s');
            $data[] = $bitacora;
        }
        return $data;
    }

}