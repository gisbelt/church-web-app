<?php

namespace content\models;


use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

/**
 *  Class donaciones model
 *
 * @package content\models
 */
class observacionDonacionModel extends Model
{
    public $id;
    public $descripcion;
    public $cantidad;
    public $donacion_id;

    // Guardar observacion donacion
    public static function guardar($cantidad, $descripcion, $donacion)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO observacion_donacion (descripcion, cantidad, donacion_id) 
        VALUES (?,?,?)");
        return $sql->execute([$descripcion, $cantidad, $donacion]);
    }

    public function rules(): array
    {
        return [
            'descripcion' => [self::RULE_REQUIRED],
            'cantidad' => [self::RULE_REQUIRED],
        ];
    }
}