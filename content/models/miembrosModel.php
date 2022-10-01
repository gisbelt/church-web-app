<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use PDO as pdo;

/**
 *  Class miembros model
 *
 * @package content\models
 */
class miembrosModel extends Model
{
    public $id;
    public $fecha_paso_de_fe;
    public $fecha_bautismo;
    public $membresia_id;
    public $status;
    public $cargo_id;
    public $fecha_creado;
    public $fecha_actualizado;

    // Obtener miembros
    public static function obtener_miembros()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT miembros.id as miembro, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo FROM miembros
                                            INNER JOIN perfiles on perfiles.miembro_id = miembros.id
                                                                 WHERE miembros.status = ?");
        $sql->execute(array(self::ACTIVE));
        $miembros = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $miembros;
    }

    // Obtener usuarios miembros
    public static function obtener_miembros_usuarios()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT miembros.id AS miembro, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo
	                                            FROM miembros
		                                            INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
		                                                WHERE miembros.id IN ( SELECT usuarios.miembro_id FROM usuarios)
                                                            and miembros.status = ?");
        $sql->execute(array(self::ACTIVE));
        $miembros = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $miembros;
    }

    // Obtener usuarios miembros
    public static function obtener_miembros_no_usuarios()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT miembros.id AS miembro, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo
	                                            FROM miembros
		                                            INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
		                                                WHERE miembros.id NOT IN ( SELECT usuarios.miembro_id FROM usuarios)
                                                            and miembros.status = ?");
        $sql->execute(array(self::ACTIVE));
        $miembros = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $miembros;
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