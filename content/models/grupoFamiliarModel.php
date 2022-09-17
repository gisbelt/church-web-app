<?php

namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class grupoFamiliarModel extends BD
{

    public $id;
    public $nombreMiembro;
    public $apellidoMiembro;
    public $nombreGrupoFamiliar;
    public $gruposFamiliaresId;
    public $miembroId;

    public function  __construct($nombreMiembro,$apellidoMiembro){
        $this->id_cliente=$id_cliente;
    }

    //Buscar miembro que no tenga grupo familiar (PARA LA LISTA)
    public static function buscarMiembroLista()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare('SELECT p.nombre, p.apellido,  p.cedula, m.id as idMiembro
        FROM miembros  m
        INNER JOIN perfiles as p ON p.miembro_id=m.id
        WHERE m.id
        not IN (select gfm.miembro_id from grupo_familiare_miembro as gfm)');
        $sql->execute();
        $buscarMiembro = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $buscarMiembro;
    }

    //Buscar miembro que no tenga grupo familiar 
    public static function buscarMiembro($nombreMiembro)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare('SELECT p.nombre as nombreMiembro, p.apellido as apellidoMiembro, p.cedula as cedulaMiembro, m.id as idMiembro
        FROM miembros  m
        INNER JOIN perfiles as p ON p.miembro_id=m.id
        WHERE m.id
        not IN (select gfm.miembro_id from grupo_familiare_miembro as gfm)
        AND (p.nombre LIKE ? or p.apellido LIKE ? or p.cedula LIKE ?)');
        $sql->execute(array("%".$nombreMiembro."%","%".$nombreMiembro."%","%".$nombreMiembro."%"));
        $buscarMiembro = $sql->fetchAll(PDO::FETCH_ASSOC); 

        $result = [];
        foreach($buscarMiembro as $key){
            $result[] = array (
                'id' => $key['idMiembro'], 
                'nombre' =>  $key['nombreMiembro'], 
                'apellido' =>  $key['apellidoMiembro'], 
                'cedula' =>  $key['cedulaMiembro'],
            );
        }

        echo json_encode($result);
    }

    //Registrar grupo familiar
    public static function registrarGrupoFamiliar($nombreGrupoFamiliar,$miembroId){
        $conexionBD=BD::crearInstancia();   
        if(isset($nombreGrupoFamiliar)){        
            $sql= $conexionBD->prepare("INSERT INTO grupos_familiares (`nombre`) VALUES (?)"); 
            $sql->execute(array($nombreGrupoFamiliar));        
            $result = [msj1 => json_encode($sql)];
            die(json_encode($result));
        }        

        $sql2 = $conexionBD->prepare("SELECT * FROM grupos_familiares as g
        WHERE g.id=(SELECT max(id) FROM grupos_familiares)");
        $sql2->execute();
        $lastID = $sql2->fetch(PDO::FETCH_ASSOC); 
        
        $sql3= $conexionBD->prepare("INSERT INTO grupo_familiare_miembro (`miembro_id`,`grupos_familiares_id`) 
        VALUES (:miembro_id,:grupos_familiares_id)");         
        $sql3->bindParam(":grupos_familiares_id", $lastID['id']);
        $sql3->bindParam(":miembro_id", $miembroId);
        $sql3->execute();
        $result = [msj2 => json_encode($sql3)];
        die(json_encode($result));
    }


}

?>