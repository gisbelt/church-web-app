<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

/**
 *  Class membresias model
 * @package content\models
 */
class membresiasModel extends Model
{
    public $id;
    public $nombre;
    public $fecha_creado;
    public $fecha_actualizado;

    public static function obtener_membresias()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id, nombre FROM membresias");
        $sql->execute();
        $membresias = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $membresias;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'nombre' => [self::RULE_REQUIRED],
        ];
    }
}