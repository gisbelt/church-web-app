<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

class cargosModel extends Model
{
    public $id;
    public $nombre;

    public static function obtener_cargos()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id, nombre FROM cargos");
        $sql->execute();
        $cargos = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $cargos;
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