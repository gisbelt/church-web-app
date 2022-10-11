<?php

namespace content\models;

use content\config\conection\database as BD;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;
use Carbon\Carbon;

class bitacoraModel extends  BD
{
    public $id;
    public $descripcion;
    public $modulo;
    public $user_id;

    // Guardar registro de bitacora
    public static function guardar($descripcion, $modulo)
    {
        $fecha = Carbon::now();
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO bitacora (descripcion, modulo, user_id, fecha_creado) 
        VALUES (?,?,?,?)");
        return $sql->execute([$descripcion, $modulo, $_SESSION['user'], $fecha]);
    }

    // Consultar registro de bitacora
    public static function consultar($user, $fechaInicial, $fechaFinal)
    {
        $connexionBD = BD::crearInstancia();
        $query = "SELECT bitacora.id, bitacora.fecha_creado AS fecha, bitacora.descripcion, bitacora.modulo, usuarios.username, usuarios.id as user FROM bitacora INNER JOIN usuarios ON usuarios.id = bitacora.user_id";

        $conditions = array();
        if (!is_null($user)) {
            $conditions[] = "usuarios.id='$user'";
        }
        if (!is_null($fechaInicial) && !is_null($fechaFinal)) {
            $conditions[] = "bitacora.fecha_creado BETWEEN '$fechaInicial' AND '$fechaFinal'";
        }

        $queryString = $query;
        if (count($conditions) > 0) {
            $queryString .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql = $connexionBD->prepare($queryString);
        $sql->execute();
        $bitacora = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $bitacora;
    }
}