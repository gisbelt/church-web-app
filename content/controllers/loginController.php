<?php 
namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class loginController {
    public function __construct()
    {

    }

    public function index(){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();
        usuarios::validarLogout();
        $data['titulo'] = 'Login';
        include_once("view/acceso/login/loginView.php");

   }

   public function iniciar( ){
       usuarios::validarLogout();
       if(isset($_POST['login'])){
           $email = $_POST['email'];
           $password = $_POST['password'];
           if($email == "" || $password == ""){
               $mensaje1 = "Por favor debe ingresar los datos";
           } else {
               //ejecutamos
               $consultarUsuario =  usuarios::login($email);
               /*$logger = new Logger("web");
               $logger->pushHandler(new StreamHandler(__DIR__."../../Logger/log.txt", Logger::DEBUG));
               $logger->debug(__METHOD__,['señor =' .$consultarUsuario['email']]);*/
               if($consultarUsuario->password == $password && $consultarUsuario->email == $email){
                   $_SESSION['email'] = 'ok';
                   $_SESSION['user_email'] = $consultarUsuario->email;
                   $_SESSION['username'] = $consultarUsuario->username;
                   $_SESSION['date'] = date('d_m_Y_H_i');
                   $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                   header("location:?url=home&action=index");
               }else{
                   $mensaje2 = "Error, el correo o contraseña son incorrectos";
               }
           }
       }
    }

    public function cerrarSesion( ){
        session_start(); 
        session_destroy();
        header("location:?url=login");
    }

    public function resetPassword( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        usuarios::validarLogout(); 
        $data['titulo'] = 'Resetear Clave';      
        include_once("view/acceso/login/resetPasswordView.php");  
    }

    public function forgotPassword( ){
        $head = new headElement();
        $bottom = new bottomComponent();
        $footer = new footerElement();        
        usuarios::validarLogout(); 
        $data['titulo'] = 'Clave Olvidada';      
        include_once("view/acceso/login/forgotPasswordView.php");     
    }
}
?>