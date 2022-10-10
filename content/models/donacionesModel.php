<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO as pdo;

/**
 *  Class donaciones model
 *
 * @package content\models
 */
class donacionesModel extends Model
{
    public $id;
    public $detalles;
    public $cantidad;
    public $status;
    public $disponible;
    public $donante;
    public $tipo_donacion;
    public $fecha_creado;
    public $fecha_actualizado;

    // Tipo donacion
    public static function tipo_donaciones()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,nombre FROM tipo_donacion");
        $sql->execute();
        $tipo_donacion = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $tipo_donacion;
    }

    // Actualizar donacion
    public static function actualizar_donacion($detalles, $cantidad, $donacion, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE donaciones SET detalles = ?, cantidad = ?, fecha_actualizado = ? WHERE id = ?");
        $donacion = $sql->execute(array($detalles, $cantidad, $fecha, $donacion));
        return $donacion;
    }

    // Guardar donacion
    public static function guardar($donante, $detalles, $tipo_donacion, $cantidad, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO donaciones (detalles, cantidad, donante_id, tipo_donacion_id, status, disponible, fecha_creado) 
        VALUES (?,?,?,?,?,?,?)");
        return $sql->execute([$detalles, $cantidad, $donante, $tipo_donacion, self::ACTIVE, self::ACTIVE, $fecha]);
    }

    // Guardar donacion
    public static function obtener_donaciones()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT donaciones.id as donacion, donaciones.disponible, detalles, cantidad, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo, donaciones.status FROM donaciones INNER JOIN miembros ON miembros.id = donaciones.donante_id 
                                INNER JOIN perfiles ON perfiles.miembro_id = miembros.id WHERE donaciones.status = ?");
        $sql->execute(array(self::ACTIVE));
        $donaciones = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $donaciones;
    }

    // obtener donacion por id
    public static function id_donacion($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT donaciones.id as donacion, donaciones.detalles, donaciones.cantidad, donante_id, tipo_donacion_id  FROM donaciones WHERE
                                            id = ?");
        $sql->execute(array($id));
        $donacion = $sql->fetch(PDO::FETCH_ASSOC);
        return $donacion;
    }

    // Eliminar donacion
    public static function eliminar($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE donaciones SET status = ? WHERE id = ?");
        $donacion = $sql->execute(array(self::INACTIVE, $id));
        return $donacion;
    }

    public function rules(): array
    {
        return [
            'detalles' => [self::RULE_REQUIRED],
            'cantidad' => [self::RULE_REQUIRED],
            'tipo_donacion' => [self::RULE_REQUIRED],
            'donante' => [self::RULE_REQUIRED]
            //password => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password]],
        ];
    }
}