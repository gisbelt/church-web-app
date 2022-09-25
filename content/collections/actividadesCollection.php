<?php
    
    namespace content\collections;
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;

    class actividadesCollection
    {
        public function formatActividades($actividades)
        {
            $data = [];
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            
            foreach ($actividades as $actividad) {
                $actividad['actions'] = sprintf(
                    '<a href="%s" class="btn btn-info me-2" target="_blank"><i class="bi bi-pencil text-light"></i></a>',
                );
                $logger->debug(__METHOD__, [$actividad]);
                $actividad['actions'] .= sprintf(
                    '<button type="button" data-route="%s" name="eliminar-donacion" id="eliminar-donacion" class="btn btn-danger ms-2"><i class="bi bi-trash text-light"></i>
                          </button>',
                );
                $data[] = $actividad;
                $logger->debug(__METHOD__, [$data]);
            }
            
          
            $logger->debug(__METHOD__, [$data]);
            return $data;
        }
    }