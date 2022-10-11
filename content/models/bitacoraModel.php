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
}