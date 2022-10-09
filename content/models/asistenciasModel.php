<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

/**
 *  Class profesiones model
 * @package content\models
 */
class asistenciasModel extends Model
{
    public $id;
    public $actividad_id;
    public $detalles;
    public $fecha_creado;
    public $fecha_actualizado;

    //Registrar asistencias
    public static function guardar($actividad_id,$detalles,$fecha_creado)
    {
        try{
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("INSERT INTO asistencias (`actividad_id`,`detalles`,`fecha_creado`,status) VALUES (?,?,?,?)");
            $asistencias = $sql->execute(array($actividad_id,$detalles,$fecha_creado,self::ACTIVE));
            return $asistencias;
        }catch(Exception $exception){
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$exception]);
            return null;
        }
    }

    //Obtener actividad_id de asistencias
    public static function obtener_asistencias_actividad($actividad_id)
    {    
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM asistencias WHERE actividad_id = ? and status=?");
        $sql->execute(array($actividad_id,self::ACTIVE));
        $asistencias = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $asistencias;
    }

    //Obtener asistencias
    public static function obtenerAsistencias()
    {    
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT actividades.nombre, asistencias.detalles, asistencias.id as asistencia, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo
        FROM asistencias 
        INNER JOIN actividades on actividades.id = asistencias.actividad_id
        INNER JOIN miembros_actividades as ma on ma.actividad_id = actividades.id
        INNER JOIN miembros on miembros.id = ma.miembro_id
        INNER JOIN perfiles on perfiles.miembro_id = miembros.id
        WHERE asistencias.status=? and ma.status=?");
        $sql->execute(array(self::ACTIVE,self::ACTIVE));
        $asistencias = $sql->fetchAll(PDO::FETCH_ASSOC);        
        return $asistencias;
    }

    //Obtener asistencias id
    public static function id_asistencias($id)
    {    
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT actividades.nombre, asistencias.actividad_id, asistencias.detalles, asistencias.id as asistencia
        FROM asistencias 
        INNER JOIN actividades on actividades.id = asistencias.actividad_id
        WHERE asistencias.id=?");
        $sql->execute(array($id));
        $asistencias = $sql->fetch(PDO::FETCH_ASSOC);        
        return $asistencias;
    }

    // Actualizar asistencia
    public static function actualizar_asistencia($actividad_id, $detalles, $fecha_actualizado, $id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE asistencias SET actividad_id = ?, detalles = ?, fecha_actualizado = ? WHERE id = ?");
        $asistencias = $sql->execute(array($actividad_id, $detalles, $fecha_actualizado, $id));
        return $asistencias;
    }

    //Desactivar asistencia
    public static  function eliminar($id) {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE asistencias SET status = ? WHERE id = ?");
        $asistencias = $sql->execute(array(self::INACTIVE, $id));
        return $asistencias;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            // 'actividad' => [self::RULE_REQUIRED],
            'detalles' => [self::RULE_REQUIRED],
        ];
    }
}