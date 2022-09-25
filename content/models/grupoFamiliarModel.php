<?php

namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarModel extends Model
{

    public $id;
    public $nombreAmigo;
    public $apellidoMiembro;
    public $nombre;
    public $direccion;
    public $lider;
    public $zona;
    public $fecha_creado;

    public function  __construct(){
        
    }

    //Buscar amigo que no tenga grupo familiar (PARA LA LISTA)
    public static function obtenerAmigo()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare('SELECT CONCAT(a.nombre," ",a.apellido) AS nombre_completo, a.cedula, a.id as amigo
        FROM amigos a
        WHERE a.id
        not IN (select gfa.amigo_id from grupo_familiare_amigo as gfa)');
        $sql->execute();
        $buscarAmigo = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $buscarAmigo;
    }

    //Buscar amigo que no tenga grupo familiar (autocompletado)
    public static function buscarAmigo($nombreAmigo)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare('SELECT CONCAT(a.nombre," ",a.apellido) AS nombre_completo, a.cedula, a.id as amigo
        FROM amigos a
        WHERE a.id
        not IN (select gfa.amigo_id from grupo_familiare_amigo as gfa)
        AND (a.nombre LIKE ? or a.apellido LIKE ? or a.cedula LIKE ?)');
        $sql->execute(array("%".$nombreAmigo."%","%".$nombreAmigo."%","%".$nombreAmigo."%"));
        $buscarAmigo = $sql->fetchAll(PDO::FETCH_ASSOC); 

        $result = [];
        foreach($buscarAmigo as $key){
            $result[] = array (
                'id' => $key['amigo'], 
                'nombre_completo' =>  $key['nombre_completo'], 
                'cedula' =>  $key['cedula'],
            );
        }

        echo json_encode($result);
    }

    //Registrar amigo a grupo familiar (NOT FINISHED YET)
    public static function guardar($nombre,$direccion,$lider,$zona,$fecha,$amigo_id){
        $conexionBD=BD::crearInstancia();   
        if(isset($nombre)){        
            $sql= $conexionBD->prepare("INSERT INTO grupos_familiares (`nombre`,`direccion`,`lider_id`,`zona_id`,`fecha_creado`) VALUES (?,?,?,?,?)"); 
            $sql->execute(array($nombre,$direccion,$lider,$zona,$fecha));        
            $result = [msj1 => json_encode($sql)];
            die(json_encode($result));
        }        

        $sql2 = $conexionBD->prepare("SELECT * FROM grupos_familiares as g
        WHERE g.id=(SELECT max(id) FROM grupos_familiares)");
        $sql2->execute();
        $lastID = $sql2->fetch(PDO::FETCH_ASSOC); 
        
        $sql3= $conexionBD->prepare("INSERT INTO grupo_familiare_amigo (`grupo_id`,`amigo_id`) 
        VALUES (:grupo_id,:amigo_id)");         
        $sql3->bindParam(":grupo_id", $lastID['id']);
        $sql3->bindParam(":amigo_id", $amigo_id);
        $sql3->execute();
        $result2 = [msj2 => json_encode($sql3)];

        $data = [
            'title' => 'Datos registrados',
            'messages' => 'El Grupo Familiar se ha registrado con exito',
            'code' => 200
        ];
        
        die(json_encode([$result2, $data]));
    }

    // Zonas
    public static function zonas()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,nombre FROM zonas WHERE status = ?");
        $sql->execute(array(self::ACTIVE));
        $zonas = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $zonas;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'nombre' => [self::RULE_REQUIRED],
            'direccion' => [self::RULE_REQUIRED],
            'lider' => [self::RULE_REQUIRED],
            'zona' => [self::RULE_REQUIRED],
        ];
    }



}

?>