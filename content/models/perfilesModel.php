<?php

namespace content\models;

use content\config\conection\database as BD;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO as pdo;

/**
 *  Class perfiles model
 * @package content\models
 */
class perfilesModel extends Model
{
    public $id;
    public $cedula;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $telefono;
    public $direccion;
    public $disponibilidad;
    public $grado_instruccion;
    public $sexo;
    public $vehiculo;
    public $miembro_id;
    public $profesion_id;
    public $fecha_creado;
    public $fecha_actualizado;

    // Actualizar miembro
    public static function actualizarPerfile($miembroID, $cedula, $nombre, $apellido, $fechaNacimiento,
                                             $telefono, $direccion, $disponibilidad, $gradoInstruccion,
                                             $sexo, $vehiculo, $profesionId, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE perfiles SET cedula = ?, nombre = ?, apellido = ?, fecha_nacimiento = ?, telefono = ?, 
                        direccion = ?, disponibilidad = ?, grado_instruccion = ?, sexo = ?, vehiculo = ?, profesion_id = ?, fecha_actualizado = ? WHERE id = ?");
        $amigo = $sql->execute(array($cedula, $nombre, $apellido, $fechaNacimiento,
            $telefono, $direccion, $disponibilidad, $gradoInstruccion,
            $sexo, $vehiculo, $profesionId, $fecha, $miembroID));
        return $amigo;
    }

    // obtener perfil por id
    public static function perfilId($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM perfiles WHERE id = ?");
        $sql->execute(array($id));
        $perfil = $sql->fetch(PDO::FETCH_ASSOC);
        return $perfil;
    }

    //Obtener miembro por cedula
    public static function obtener_miembro_cedula($cedula)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT perfiles.*, miembros.* FROM miembros INNER JOIN perfiles ON miembros.id = perfiles.miembro_id WHERE perfiles.cedula = ?");
        $sql->execute(array($cedula));
        $perfil = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $perfil;
    }

    //Crear miemrbo
    public static function crear($miembroId, $cedula, $nombre, $apellido, $fechaNacimiento, $telefono, $direccion, $disponibilidad, $gradoInstruccion, $sexo, $vehiculo, $profesionId, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO perfiles (cedula, nombre, apellido, fecha_nacimiento, telefono, direccion, disponibilidad,
                                            grado_instruccion, sexo, vehiculo, miembro_id, profesion_id, fecha_creado) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $perfil = $sql->execute(array($cedula, $nombre, $apellido, $fechaNacimiento, $telefono, $direccion, $disponibilidad, $gradoInstruccion, $sexo, $vehiculo, $miembroId, $profesionId, $fecha));
        return $perfil;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'cedula' => [self::RULE_REQUIRED, [self::RULE_CEDULA_MIN, 'cedula_min' => 8], [self::RULE_CEDULA_MAX, 'cedula_max' => 11]],
            'telefono' => [self::RULE_NULL, [self::RULE_TELEFONO_MIN, 'telefono_min' => 10], [self::RULE_TELEFONO_MAX, 'telefono_max' => 15]]
        ];
    }
}