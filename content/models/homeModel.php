<?php
namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class homeModel extends Model {
       
    
    public static function countAmigos(){
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(*) as numrows FROM amigos where status=?");
        $sql->execute(array(self::ACTIVE));
        $countAmigos = $sql->fetch(PDO::FETCH_ASSOC);        
        return $countAmigos;
    }

    public static function countMiembrosActivos(){
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(*) as numrows FROM miembros where membresia_id=?");
        $sql->execute(array(2));
        $countAmigos = $sql->fetch(PDO::FETCH_ASSOC);        
        return $countAmigos;
    }

    public static function countMiembrosPasivos(){
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(*) as numrows FROM miembros where membresia_id=?");
        $sql->execute(array(1));
        $countAmigos = $sql->fetch(PDO::FETCH_ASSOC);        
        return $countAmigos;
    }

    public static function countDonaciones(){
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(*) as numrows FROM donaciones where status=?");
        $sql->execute(array(self::ACTIVE));
        $countAmigos = $sql->fetch(PDO::FETCH_ASSOC);        
        return $countAmigos;
    }

    public static function cargarActividades($fecha)
    {
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("SELECT actividades.id, actividades.nombre, actividades.descripcion, actividades.status, tipo_actividad.nombre as tipo, horarios.hora, horarios.fecha
            FROM actividades
            INNER JOIN actividades_horarios ON actividades.id = actividades_horarios.actividad_id
            INNER JOIN horarios ON actividades_horarios.horario_id = horarios.id
            INNER JOIN tipo_actividad ON actividades.tipo_actividad_id = tipo_actividad.id
            WHERE actividades.status=? 
            AND horarios.fecha >= ?
            ORDER BY horarios.fecha DESC LIMIT 6");
            $sql->execute(array(self::ACTIVE, $fecha));
            $actividades = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $actividades;
    }

    // Consultar registro de bitacora
    public static function bitacoraLastActions()
    {
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("SELECT bitacora.id, bitacora.fecha_creado AS fecha, bitacora.descripcion, bitacora.modulo, usuarios.username as user, usuarios.id
            FROM bitacora 
            INNER JOIN usuarios ON usuarios.id = bitacora.user_id 
            ORDER BY bitacora.fecha_creado DESC LIMIT 6");
            $sql->execute();
            $bitacora = $sql->fetchAll(PDO::FETCH_ASSOC);
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$bitacora]);
            return $bitacora;
    }
    

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
           
        ];
    }


}
?>