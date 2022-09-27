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
    public $grupo_id;

    public function  __construct(){
        
    }

    //Buscar amigo que no tenga grupo familiar (PARA LA LISTA)
    public static function obtenerAmigo()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare('SELECT CONCAT(a.nombre," ",a.apellido) AS nombre_completo, a.cedula, a.id as amigo
        FROM amigos a
        WHERE a.id
        not IN (select gfa.amigo_id from grupo_familiare_amigo as gfa WHERE gfa.status=?)
        AND (a.status=?)');
        $sql->execute(array(self::ACTIVE,self::ACTIVE));
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
        not IN (select gfa.amigo_id from grupo_familiare_amigo as gfa WHERE gfa.status=?)
        AND (a.nombre LIKE ? or a.apellido LIKE ? or a.cedula LIKE ?) AND (a.status=?)');
        $sql->execute(array(self::ACTIVE,"%".$nombreAmigo."%","%".$nombreAmigo."%","%".$nombreAmigo."%",self::ACTIVE));
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

    //  Registrar grupo y amigo a grupo familiar (NOT FINISHED YET)
    public static function guardar($nombre,$direccion,$lider,$zona,$fecha,$amigo_id){
        $conexionBD=BD::crearInstancia();   
        if(isset($nombre)){        
            $sql= $conexionBD->prepare("INSERT INTO grupos_familiares (`nombre`,`direccion`,`lider_id`,`zona_id`,`fecha_creado`,status) VALUES (?,?,?,?,?,?)"); 
            $sql->execute(array($nombre,$direccion,$lider,$zona,$fecha,self::ACTIVE));        
            $result = [msj1 => $sql];
            die(json_encode($result));
        }        

        $sql2 = $conexionBD->prepare("SELECT * FROM grupos_familiares as g
        WHERE g.id=(SELECT max(id) FROM grupos_familiares)");
        $sql2->execute();
        $lastID = $sql2->fetch(PDO::FETCH_ASSOC); 
        
        $sql3= $conexionBD->prepare("INSERT INTO grupo_familiare_amigo (`grupo_id`,`amigo_id`,status) VALUES (?,?,?)");   
        $sql3->execute(array($lastID['id'],$amigo_id,self::ACTIVE));
        $result2 = [msj2 => $sql3];
        $data = [
            'title' => 'Datos registrados',
            'messages' => 'El Grupo Familiar se ha registrado con exito',
            'code' => 200
        ];
        
        die(json_encode([$result2, $data]));
    }

    // Obtener grupos
    public static function obtenerGrupos()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT gf.id as grupo, gf.nombre, gf.direccion, perfiles.nombre as lider, zonas.nombre as zona
        FROM grupos_familiares as gf
        INNER JOIN miembros on miembros.id = gf.lider_id
        INNER JOIN perfiles on perfiles.id = miembros.id
        INNER JOIN zonas on zonas.id = gf.zona_id
        WHERE gf.status=?");
        $sql->execute(array(self::ACTIVE));
        $grupos = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $grupos;
    }

    // obtener Integrantes (Amigos) Grupo
    public static function obtenerIntegrantesGrupo($grupo_id){
        $conexionBD = BD::crearInstancia();
        $query = "SELECT CONCAT(a.cedula,' - ',a.nombre,' ',a.apellido) AS nombre_completo, a.id as amigo 
        FROM grupos_familiares as gf
        INNER JOIN grupo_familiare_amigo gfa on gfa.grupo_id = gf.id
        INNER JOIN amigos a on a.id = gfa.amigo_id";
        $conditions = array();
        if($grupo_id != '') {
            $conditions[] = "gf.id='$grupo_id'";
        }
        $queryString = $query;
        if (count($conditions) > 0) {
            $queryString .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql2 = $conexionBD->prepare($queryString);
        $sql2->execute();
        $integrantes = $sql2->fetchAll(PDO::FETCH_ASSOC);
        return $integrantes;
    }

    //Eliminar Grupo
    public static function eliminarGrupo($grupo_id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE grupos_familiares AS gf
        INNER JOIN grupo_familiare_amigo AS gfa ON gf.id=gfa.grupo_id
        SET gf.status=?, gfa.status=? 
        WHERE gf.id=?");
        $grupos = $sql->execute(array(self::INACTIVE,self::INACTIVE,$grupo_id));
        return $grupos;
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

    // Lider
    public static function lider()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT miembros.id as miembro, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo FROM miembros
        INNER JOIN perfiles on perfiles.miembro_id = miembros.id
        INNER JOIN cargos on cargos.id = miembros.cargo_id
        WHERE miembros.status = ? AND miembros.cargo_id=3");
        $sql->execute(array(self::ACTIVE));
        $lider = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $lider;
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