<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO as pdo;

/**
 *  Class notificacion model
 *
 * @package content\models
 */
class notificacionModel extends Model
{
    public $id;
    public $mesanje;
    public $fecha_creado;
    public $fecha_actualizado;

    public static function agregar_mensaje($mensaje, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO notificacion (mesanje, status, fecha_creado) 
        VALUES (?,?,?)");
        $sql->execute([$mensaje, self::ACTIVE, $fecha]);
        $notificacion = $conexionBD->lastInsertId();

        $sql = $conexionBD->prepare("INSERT INTO notificacion_usuario (usuario_id, notificacion_id, status, autor, fecha_creado) 
        VALUES (?,?,?,?,?)");
        return $sql->execute([$_SESSION['user'], $notificacion, self::ACTIVE, self::ACTIVE, $fecha]);
    }

    // obtener notificacion
    public static function obtener_notificacion()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT notificacion.id, notificacion.mesanje, notificacion.status, notificacion.fecha_creado  FROM notificacion
                                                INNER JOIN notificacion_usuario ON notificacion.id = notificacion_usuario.notificacion_id    
                                                        WHERE notificacion_usuario.usuario_id != ? and notificacion.status = ?");
        $sql->execute(array($_SESSION['user'], self::ACTIVE));
        $notificacion = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $notificacion;
    }

    public function rules(): array
    {
        return [];
    }
}