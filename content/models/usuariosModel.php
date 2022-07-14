<?php
namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;

class usuariosModel extends BD{

    public $id;
    public $cedula;
    public $nombre;
    public $correo;
    public $telefono;
    public $direccion;  
    public $clave;
    
    //Login
    public static function login($correo){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT correo,clave,nombre 
        FROM usuarios WHERE correo=?"); 
        $sql->execute(array($correo));
        $consultarUsuario=$sql->fetch(PDO::FETCH_LAZY);
        return $consultarUsuario;
    }

    //Validación del login
    public static function validarLogin(){
        header("Cache-control: private");
        header("Cache-control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        // Si la sesion esta vacía o no hay usuario logueado, redirecciona al login
        if(!isset($_SESSION['correo'])){
            header("Location:?url=login");     
        }else{
            // sino, si ese usuario tiene un valor, imprime esa información
            if($_SESSION['correo']=='ok'){
                $nombreUsuario=$_SESSION['nombreUsuario'];
                $date=$_SESSION['date'];
            }
        }
    }

    // Validar que esté la sesión cerrada 
    public static function validarLogout(){
        // Si existe alguien logueado, mosrar alerta de cerrar sesión
        if(isset($_SESSION['correo'])){
            echo "
            <script>
            alert('Por favor cerrar sesión');
            window.location.href = '?url=home';
            </script>";
        }
    }

}
?>