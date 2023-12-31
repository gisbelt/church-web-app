<?php

namespace content\models;

use content\core\Model;
use content\config\conection\database as BD;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class amigosModel extends Model
{

    public $id;
    public $cedula;
    public $telefono;
    public $nombre;
    public $apellido;
    public $fecha_naciemiento;
    public $sexo;
    public $status;
    public $como_llego;

    //buscar amigos id
    public static function amigoId($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM amigos WHERE id = ?");
        $sql->execute(array($id));
        $amigos = $sql->fetch(PDO::FETCH_ASSOC);
        return $amigos;
    }

    //buscar amigos cedula
    public static function buscarAmigoCedula($cedula)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM amigos WHERE cedula = ?");
        $sql->execute(array($cedula));
        $amigos = $sql->fetch(PDO::FETCH_ASSOC);
        return $amigos;
    }

    public static function obtenerAmigos($cedula, $sexo,  $fechaNacimiento)
    {
        $connexionBD = BD::crearInstancia();
        $query = "SELECT amigos.id as amigo, amigos.sexo, DATE(amigos.fecha_nacimiento) AS nacimiento, amigos.cedula, amigos.telefono, amigos.status,CONCAT(amigos.nombre,' ',amigos.apellido) AS nombre_completo FROM amigos";
        $conditions = array();

        if(!is_null($cedula)) {
            $conditions[] = "amigos.cedula='$cedula'";
        }
        if(!is_null($fechaNacimiento)) {
            $conditions[] = "amigos.fecha_nacimiento='$fechaNacimiento'";
        }
        if(!is_null($sexo)) {
            if ($sexo == 'true'){
                $conditions[] = "amigos.sexo=1";
            } else if($sexo == 'false'){
                $conditions[] = "amigos.sexo=0";
            }
        }
        $queryString = $query;
        if (count($conditions) > 0) {
            $queryString .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql = $connexionBD->prepare($queryString);
        $sql->execute();
        $amigos = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $amigos;
    }

    //Guardar amigo
    public static function guardar($cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $como_llego, $fecha_naciemiento, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO amigos (cedula, nombre, apellido, sexo, direccion, telefono, como_llego, fecha_nacimiento, status, fecha_creado) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $amigos = $sql->execute(array($cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $como_llego, $fecha_naciemiento, self::ACTIVE, $fecha));
        return $amigos;
    }

    //eliminar
    public static  function eliminar($id) {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE amigos SET status = ? WHERE id = ?");
        $amigos = $sql->execute(array(self::INACTIVE, $id));
        return $amigos;
    }

    // Actualizar amigo
    public static function actualizar($id, $cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $comoLlego, $fechaNacimiento, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE amigos SET cedula = ?, nombre = ?, apellido = ?, sexo = ?, direccion = ?, telefono = ?, como_llego = ?, fecha_nacimiento = ?, fecha_actualizado = ? WHERE id = ?");
        $amigo = $sql->execute(array($cedula, $nombre, $apellido, $sexo, $direccion, $telefono, $comoLlego, $fechaNacimiento, $fecha, $id));
        return $amigo;
    }

    // Convertir miembro
    public static function covertirMiembro($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE amigos SET status = ? WHERE id = ?");
        $amigo = $sql->execute(array(self::INACTIVE, $id));
        return $amigo;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'cedula' => [self::RULE_REQUIRED],
        ];
    }
}