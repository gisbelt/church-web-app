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
    public $fecha_actualizado;
    public $grupo_id;
    public $amigo_id;
    public $status;

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

    //  Registrar grupo y amigo a grupo familiar 
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
        $sql = $conexionBD->prepare("SELECT gf.id as grupo, gf.nombre, gf.direccion, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS lider, zonas.nombre as zona
        FROM grupos_familiares as gf
        INNER JOIN miembros on miembros.id = gf.lider_id
        INNER JOIN perfiles on perfiles.id = miembros.id
        INNER JOIN zonas on zonas.id = gf.zona_id
        WHERE gf.status=?");
        $sql->execute(array(self::ACTIVE));
        $grupos = $sql->fetchAll(PDO::FETCH_ASSOC);        
        return $grupos;
    }

    public static function id_grupo($grupo_id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT gf.id as grupo, gf.nombre, gf.direccion, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS lider, gf.lider_id, zonas.nombre as zona, gf.zona_id
        FROM grupos_familiares as gf
        INNER JOIN miembros on miembros.id = gf.lider_id
        INNER JOIN perfiles on perfiles.id = miembros.id
        INNER JOIN zonas on zonas.id = gf.zona_id
        WHERE gf.id=?");
        $sql->execute(array($grupo_id));
        $grupos = $sql->fetch(PDO::FETCH_ASSOC);
        return $grupos;
    }

    // obtener Integrantes (Amigos) Grupo
    public static function obtenerIntegrantesGrupo($grupo_id){
        $conexionBD = BD::crearInstancia();
        $query = "SELECT CONCAT(a.cedula,' - ',a.nombre,' ',a.apellido) AS nombre_completo, a.id as amigo, gfa.grupo_id 
        FROM grupos_familiares as gf
        INNER JOIN grupo_familiare_amigo gfa on gfa.grupo_id = gf.id
        INNER JOIN amigos a on a.id = gfa.amigo_id";
        $conditions = array();
        if($grupo_id != '') {
            $conditions[] = "gfa.status=".self::ACTIVE;
        }
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

    //Actualizar Grupo
    public static function actualizar($nombre, $direccion, $lider, $zona, $fecha_actualizado, $grupo_id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE grupos_familiares SET nombre = ?, direccion = ?, lider_id = ?, zona_id = ?, fecha_actualizado = ? WHERE id = ?");
        $grupo = $sql->execute(array($nombre, $direccion, $lider, $zona, $fecha_actualizado, $grupo_id));
        return $grupo;
    }

    //Eliminar Grupo
    public static function eliminar($grupo_id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE grupos_familiares AS gf
        INNER JOIN grupo_familiare_amigo AS gfa ON gf.id=gfa.grupo_id
        SET gf.status=?, gfa.status=? 
        WHERE gf.id=?");
        $grupos = $sql->execute(array(self::INACTIVE,self::INACTIVE,$grupo_id));
        return $grupos;
    }

    //Asignar Amigos
    public static function asignarAmigos($grupo_id,$amigo_id){
        $conexionBD = BD::crearInstancia();
        $sql3= $conexionBD->prepare("INSERT INTO grupo_familiare_amigo (`grupo_id`,`amigo_id`,status) VALUES (?,?,?)");   
        $amigos=$sql3->execute(array($grupo_id,$amigo_id,self::ACTIVE));
        return $amigos;
    }

    //Eliminar Amigo
    public static function eliminarAmigo($amigo_id,$grupo_id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("DELETE FROM grupo_familiare_amigo WHERE amigo_id=? AND grupo_id=?");
        $amigos = $sql->execute(array($amigo_id,$grupo_id));
        return $amigos;
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

     // reportes cantidad grupos por mes
     public static function reporteGrupos()
     {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(grupos_familiares.nombre) as cantidad, MONTH(grupos_familiares.fecha_creado) as mes FROM  grupos_familiares
        GROUP BY grupos_familiares.nombre");
        $sql->execute();
        $reporte = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $reporte;
     }

    //  cantidad de amigos de cada grupo familiar
    public static function reporteGrupos2($fecha_inicial,$fecha_final)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(grupo_familiare_amigo.amigo_id) as cantidad_amigos,
        grupos_familiares.nombre as grupo
        FROM grupos_familiares
        INNER JOIN grupo_familiare_amigo ON grupos_familiares.id = grupo_familiare_amigo.grupo_id
        WHERE grupos_familiares.fecha_creado BETWEEN ? and ?
        GROUP BY grupo");
        $sql->execute(array($fecha_inicial,$fecha_final));
        $reporte = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $reporte;
    }

    //  cantidad de grupos familiares ingresados en el mes
    public static function reporteGrupos3($fecha_inicial,$fecha_final)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT COUNT(grupos_familiares.id) as cantidad_familia,
		grupos_familiares.nombre as grupo
        FROM grupos_familiares
		WHERE grupos_familiares.fecha_creado BETWEEN ? and ?
        GROUP BY grupo");
        $sql->execute(array($fecha_inicial,$fecha_final));
        $reporte = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $reporte;
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