<?php 
namespace content\controller;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

$head = new headElement();
$bottom = new bottomComponent();
$footer = new footerElement();

usuarios::validarLogout();

if(isset($_POST['login'])){
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    if($correo=="" || $clave==""){
        $mensaje1="Por favor debe ingresar los datos";
    }
    else{
        //ejecutamos
        $consultarUsuario=usuarios::login($correo); 
        if($consultarUsuario['clave']==$clave && $consultarUsuario['correo']==$correo){
            $_SESSION['correo']='ok';
            $_SESSION['correoUsuario']=$consultarUsuario->correo;
            $_SESSION['nombreUsuario']=$consultarUsuario->nombre;
            $_SESSION['date']=date('d_m_Y_H_i');
            $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
            header("location:?url=home");  
        }else{
            $mensaje2="Error, el correo o contraseña son incorrectos";
        }    
    }  
}

include_once("view/usuarios/loginView.php");   

?>