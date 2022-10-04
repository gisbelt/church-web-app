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
        $sql->execute(array($fechaPasoFe, $fechaBautismo, $membresia, self::ACTIVE, $cargo, $fecha ));
        return $conexionBD->lastInsertId();
    }

public static function miemrbosSelect()
{
    try{
    $conexionBD = BD::crearInstancia();
    $sql = $conexionBD->prepare("SELECT miembros.id, perfiles.nombre, membresias.nombre as status FROM miembros INNER JOIN membresias
	ON miembros.membresia_id = membresias.id INNER JOIN perfiles ON miembros.id = perfiles.miembro_id
	where membresias.nombre = 'activo'");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
    }catch(\Exception $exception){
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$exception]);
        return null;
    }
}
    public function rules(): array
    {
        return [ ];
    }
}