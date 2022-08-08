<?php
namespace content\config\conection;
use PDO as pdo;
use PDOException;

class database{
    private static $instancia=NULL;

    // Crear una instancia a partir de una conexión 
    public static function crearInstancia(){
        // Si no hay una conexion, créala
        if(!isset(self::$instancia)){
            // Me servirá para cambiar el acceso o algunas propiedades que va a requerir mi conexion  
            // Para notificar de errores ATTR_ERRMODE
            $opcionesPDO[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            // Creando la instancia

            self::$instancia= new PDO(_DB_MANAGER_.':host='._DB_HOST_.':'._DB_PORT_.';dbname='._DB_WEB_,_DB_USER_,'',$opcionesPDO);
            // echo "conexion realizada";
        }
        return self::$instancia;
    }
}
?>