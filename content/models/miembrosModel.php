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

public static function miemrbosSelect()
{

    $conexionBD = BD::crearInstancia();
    $sql = $conexionBD->prepare("SELECT miembros.id, perfiles.nombre, membresias.nombre as status FROM miembros INNER JOIN membresias
	ON miembros.membresia_id = membresias.id INNER JOIN perfiles ON miembros.id = perfiles.miembro_id
	where membresias.nombre = 'activo'");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);

}
    public static function obtener_miembros_filtro($nombre, $sexo, $tipo_fecha, $fecha)
    {
        $connexionBD = BD::crearInstancia();
        $query = "SELECT miembros.id, DATE(miembros.fecha_paso_de_fe) AS fecha_fe, DATE(miembros.fecha_bautismo) AS fecha_bautismo, miembros.status, profesiones.nombre AS profesion, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo, perfiles.cedula, perfiles.telefono FROM miembros INNER JOIN perfiles ON miembros.id = perfiles.miembro_id
                       INNER JOIN profesiones ON perfiles.profesion_id = profesiones.id ";
        $conditions = array();
        if ($nombre != '') {
            $conditions[] = "perfiles.nombre LIKE '%$nombre%'";
        }
        if ($sexo != '') {
            if ($sexo == 'true'){
                $conditions[] = "perfiles.sexo=1";
            } else if($sexo == 'false'){
                $conditions[] = "perfiles.sexo=0";
            }
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
        $sql = $connexionBD->prepare($queryString);
        $sql->execute();
        $miembros = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $miembros;
    }

    public static  function eliminar($id) {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE miembros SET status = ? WHERE id = ?");
        $miembros = $sql->execute(array(self::INACTIVE, $id));
        return $miembros;
    }

    // reporte donacion
    public static function reporteMiembros($fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(perfiles.sexo) as cantidad, perfiles.sexo, DATE(perfiles.fecha_nacimiento) FROM  miembros
	                INNER JOIN perfiles ON miembros.id = perfiles.miembro_id WHERE DATE(perfiles.fecha_nacimiento)=?
	            GROUP BY perfiles.sexo, DATE(perfiles.fecha_nacimiento)");
        $sql->execute(array($fecha));
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$sql]);
        $miembros = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $miembros;
    }

    public function rules(): array
    {
        return [];
    }
}