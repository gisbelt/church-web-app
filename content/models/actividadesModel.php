<?php
    
namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use DateTime;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO as pdo;

/**
 *
 */
class actividadesModel extends Model
{
    public $nombre;
    public $descripcion;
    
    /**
     * @return array|false|string
     */
    public static function cargarActividades()
    {
        try{
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("SELECT
                                                actividades.nombre,
                                                actividades.descripcion,
                                                actividades.status,
                                                tipo_actividad.nombre as tipo,
                                                horarios.hora,
                                                horarios.fecha
                                            FROM
                                                actividades
                                                INNER JOIN
                                                actividades_horarios
                                                ON
                                                    actividades.id = actividades_horarios.actividad_id
                                                INNER JOIN
                                                horarios
                                                ON
                                                    actividades_horarios.horario_id = horarios.id
                                                INNER JOIN
                                                tipo_actividad
                                                ON
		                            actividades.tipo_actividad_id = tipo_actividad.id");
            $sql->execute();
           
            $actividades = $sql->fetchAll(PDO::FETCH_ASSOC);
           $logger = new Logger("web");
           $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$actividades]);
            return $actividades;
        }catch(Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return 'No disponible';
        }
    }
    
    /**
     * @param $nombre
     * @param $descripcion
     * @param $status
     * @param $tipo
     * @param $fecha
     *
     * @return array|null
     */
    public static function registrarActividades($nombre, $descripcion, $status, $tipo, $fecha)
    {
        try{
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("INSERT INTO `actividades`(`nombre`, `descripcion`, `status`, `tipo_actividad_id`, `fecha_creado`, `fecha_actualizado`) VALUES ( ?, ?, ?, ?, ?, ?)");
            $actividades =  $sql->execute([$nombre, $descripcion, $status, $tipo, $fecha,$fecha]);
            $id = $conexionBD->lastInsertId();
            $data = ['id'=> $id, 'actividades'=> $actividades];
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$data]);
            return $data;
        }catch(Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return null;
        }
       
    }
    public static function modificarActividades($nombre,$descripcion,$status,$tipo,$fechaActualizada,$id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE `actividades` SET `nombre` = '$nombre', `descripcion` = '$descripcion', `status` = '$status', `tipo_actividad_id` = '$tipo', `fecha_actualizado` = '$fechaActualizada' WHERE `id` ='$id'");
        return $sql->execute();
    }
    public static function desactivarActividades($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM actividades WHERE actividades.id=".'$id');
        $sql->execute();
        
    }
        public function tipoActividad()
        {
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("SELECT tipo_actividad.nombre,tipo_actividad.id FROM tipo_actividad");
            $sql->execute();
        }
    
    /**
     * @param $hora
     * @param $fecha
     * @param $fechaCreacion
     *
     * @return array|null
     */
    public static function horariosCreate($hora, $fecha, $fechaCreacion)
        {
            try{
                $conexionBD = BD::crearInstancia();
                $date = str_replace('/', '-', $fecha);
                $fechaNew = date('Y-m-d', strtotime($date));
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$fechaNew]);
                $sql = $conexionBD->prepare("INSERT INTO `horarios`(`hora`, `fecha`, `fecha_creado`, `fecha_actualizado`) VALUES (?, ?, ?, ?);");
                $horarios = $sql->execute([$hora, $fechaNew,$fechaCreacion,$fechaCreacion]);
                $id = $conexionBD->lastInsertId();
                $data = ['id'=> $id, 'horarios'=> $horarios];
                return $data;
            }catch(Exception $exception){
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$exception]);
                return null;
            }
        }
    
    /**
     * @param $actividadId
     * @param $horarioId
     * @param $fecha
     *
     * @return bool|null
     */
    public static function actividadesHorariosCreate($actividadId, $horarioId, $fecha)
        {
            try{
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->prepare("INSERT INTO `actividades_horarios`(`actividad_id`, `horario_id`, `fecha_creado`, `fecha_actualizado`) VALUES (?, ?, ?, ?);");
                return $sql->execute([$actividadId,$horarioId,$fecha,$fecha]);
            }catch(Exception $exception){
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$exception]);
                return null;
            }
        }
    
    /**
     * @param $actividadId
     * @param $descripcion
     * @param $fecha
     *
     * @return bool|null
     */
    public static function observacionActividad($actividadId, $descripcion, $fecha)
        {
            try{
                $conexionBD = BD::crearInstancia();
                if(!is_null($descripcion)){
                    $sql = $conexionBD->prepare("INSERT INTO `observacion_actividad`(`descripcion`, `actividad_id`, `fecha_creado`, `fecha_actualizado`) VALUES (?, ?, ?, ?);");
                    return $sql->execute([$descripcion,$actividadId,$fecha,$fecha]);
                }else{
                    return null;
                }
               
            }catch(Exception $exception){
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$exception]);
                return null;
            }
        }
    
    /**
     * @param $miembroId
     * @param $actividadId
     * @param $status
     * @param $fecha
     *
     * @return bool|null
     */
    public static function miembroActividad($miembroId, $actividadId, $status, $fecha)
        {
            try{
                $conexionBD = BD::crearInstancia();
                if(!is_null($miembroId)){
                    $sql = $conexionBD->prepare("INSERT INTO `miembros_actividad`(`miembro_id`, `actividad_id`, `status`,`fecha_creado`, `fecha_actualizado`) VALUES (?, ?,?, ?, ?);");
                    return $sql->execute([$miembroId,$actividadId,$fecha,$fecha]);
                }else{
                    $logger = new Logger("web");
                    $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                    $logger->debug(__METHOD__, [$miembroId]);
                    return null;
                }
               
            }catch(Exception $exception){
                $logger = new Logger("web");
                $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
                $logger->debug(__METHOD__, [$exception]);
                return null;
            }
        }
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'nombre' => [self::RULE_REQUIRED],
            'descripcion' => [self::RULE_REQUIRED],
        ];
    }
}