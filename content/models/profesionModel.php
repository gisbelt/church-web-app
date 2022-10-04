<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

/**
 *  Class profesiones model
 * @package content\models
 */
class profesionModel extends Model
{
    public $id;
    public $nombre;
    public $fecha_creado;
    public $fecha_actualizado;

    public static function obtener_profesiones()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id, nombre FROM profesiones");
        $sql->execute();
        $profesiones = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $profesiones;
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