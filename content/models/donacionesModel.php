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
class donacionesModel extends Model
{
    public $id;
    public $detalles;
    public $cantidad;
    public $donante_id;
    public $tipo_id;
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

    public function rules(): array
    {
        return [
            'datalles' => [self::RULE_REQUIRED],
            'cantidad' => [self::RULE_REQUIRED]
            //password => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password]],
        ];
    }
}