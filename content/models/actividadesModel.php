<?php
    
namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO as pdo;

class actividadesModel extends Model
{
    public $nombre;
    public $descripcion;
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
            return 'No disponible';
        }
    }
    public static function registrarActividades()
    {
//        $conexionBD = BD::crearInstancia();
//        $sql = $conexionBD->prepare("INSERT INTO actividades (detalles, cantidad, donante_id, tipo_donacion_id, status, disponible, fecha_creado)
//        VALUES (?,?,?,?,?,?,?)");
//        return $sql->execute([$detalles, $cantidad, $donante, $tipo_donacion, self::ACTIVE, self::ACTIVE, $fecha]);
    }
    public static function modificarActividades(){}
    public static function desactivarActividades($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM actividades WHERE actividades.id=".'$id');
        $sql->execute();
        
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