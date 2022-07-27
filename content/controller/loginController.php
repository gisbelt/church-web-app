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
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email=="" || $password==""){
        $mensaje1="Por favor debe ingresar los datos";
    }
    else{
        //ejecutamos
        $consultarUsuario=usuarios::login($email); 
        if($consultarUsuario['password']==$password && $consultarUsuario['email']==$email){
            $_SESSION['email']='ok';
            $_SESSION['user_email']=$consultarUsuario->email;
            $_SESSION['username']=$consultarUsuario->username;
            $_SESSION['date']=date('d_m_Y_H_i');
            $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
            header("location:?url=home");  
        }else{
            $mensaje2="Error, el correo o contraseña son incorrectos";
        }    
    }  
}

include_once("view/acceso/usuarios/loginView.php");   

?>