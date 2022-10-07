<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
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

    //Crear miemrbo
    public static function crear($fechaPasoFe, $fechaBautismo, $membresia, $cargo, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO miembros (fecha_paso_de_fe, fecha_bautismo, membresia_id, status, cargo_id, fecha_creado) 
        VALUES (?,?,?,?,?,?)");
        $sql->execute(array($fechaPasoFe, $fechaBautismo, $membresia, self::ACTIVE, $cargo, $fecha));
        return $conexionBD->lastInsertId();
    }

    public static function obtener_miembros_filtro($nombre, $sexo, $tipo_fecha, $fecha)
    {
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $connexionBD = BD::crearInstancia();
        $query = "SELECT miembros.id, DATE(miembros.fecha_paso_de_fe) AS fecha_fe, DATE(miembros.fecha_bautismo) AS fecha_bautismo, miembros.status, profesiones.nombre AS profesion, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo, perfiles.cedula, perfiles.telefono FROM miembros INNER JOIN perfiles ON miembros.id = perfiles.miembro_id
                       INNER JOIN profesiones ON perfiles.profesion_id = profesiones.id ";
        $conditions = array();
        if ($nombre != '') {
            $conditions[] = "perfiles.nombre LIKE '%$nombre%'";
        }
        if ($sexo != '') {
            $conditions[] = "perfiles.sexo='$sexo'";
        }
        if ($tipo_fecha != '') {
            if ($tipo_fecha == '1') {
                $conditions[] = "DATE(miembros.fecha_paso_de_fe)='$fecha'";
            } else if ($tipo_fecha == '2') {
                $conditions[] = "DATE(miembros.fecha_bautismo)='$fecha'";
            }
        }

        $queryString = $query;
        if (count($conditions) > 0) {
            $queryString .= " WHERE " . implode(' AND ', $conditions);
        }
        $logger->debug(__METHOD__, [$queryString]);
        $sql = $connexionBD->prepare($queryString);
        $sql->execute();
        $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }

    public static  function eliminar($id) {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE miembros SET status = ? WHERE id = ?");
        $miembros = $sql->execute(array(self::INACTIVE, $id));
        return $miembros;
    }

    public function rules(): array
    {
        return [];
    }
}