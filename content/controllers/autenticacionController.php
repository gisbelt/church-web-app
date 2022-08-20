<?php 
namespace content\controllers;

use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AutenticacionController {
    
    public function __construct()
    {

    }

    public function index(){
        usuarios::validarLogout();
        $data['titulo'] = 'Login';
        return  new Response(require_once (realpath(dirname(__FILE__) .'./../../views/acceso/login/loginView.php')), 200);

   }

   public function iniciar(Request $request){
       $email = $request->request->get('email');
       $password = $request->request->get('password');
       usuarios::validarLogout();
       /*$email = $_POST['email'];
       $password = $_POST['password'];*/
       if ($email == "" || $password == "") {
           $mensaje1 = "Por favor debe ingresar los datos";
       } else {
           //ejecutamos
           $consultarUsuario = usuarios::login($email);

           if ($consultarUsuario && $password = $consultarUsuario['password']) {
               $_SESSION['email'] = 'ok';
               $_SESSION['user_email'] = $consultarUsuario->email;
               $_SESSION['username'] = $consultarUsuario->username;
               $_SESSION['date'] = date('d_m_Y_H_i');
               $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
               return new RedirectResponse('/home', 302);
           } else {
               $mensaje2 = "Error, el correo o contraseña son incorrectos";
           }
       }
    }

    public function cerrarSesion( ){
        unset($_SESSION['email']);
        unset($_SESSION['user_email']);
        unset($_SESSION['username']);
        unset($_SESSION['date']);
        unset($_SESSION['ip']);
        session_destroy();
        return new RedirectResponse('/', 302);
    }

    public function resetPassword( ){
        usuarios::validarLogout(); 
        $data['titulo'] = 'Resetear Clave';      
        include_once("view/acceso/login/resetPasswordView.php");  
    }

    public function forgotPassword( ){
        usuarios::validarLogout(); 
        $data['titulo'] = 'Clave Olvidada';      
        include_once("view/acceso/login/forgotPasswordView.php");     
    }
}
?>