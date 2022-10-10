<?php
    
    namespace content\collections;
    
    use content\enums\estadosActividad as status;
    use DateTime;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;

    class actividadesCollection
    {
        public function formatActividades($actividades)
        {
            $data = [];
            foreach ($actividades as $actividad) {
                switch ($actividad['status']){
                    case status::$en_curso:
                        $actividad['status'] = 'En Curso';
                        break;
                    case status::$en_pausa:
                        $actividad['status'] = 'En Pausa';
                        break;
                    case status::$terminado:
                        $actividad['status'] = 'Terminado';
                        break;
                    case status::$cancelado:
                        $actividad['status'] = 'Cancelado';
                        break;
                    default:{
                        $actividad['status'] = 'No Disponible';
                    }
                }
                $actividad['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                    '/actividades/editar/' . $actividad['id']
                );
                $actividad['actions'] .= sprintf(
                    '<button type="button"  name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                );
                $date = $actividad['fecha'].' '.$actividad['hora'];
                $date = new DateTime($date);
                $actividad['fecha'] = $date->format('d/m/Y H:i:s');
                $data[] = $actividad;
            }
            
          
            
            return $data;
        }
    }