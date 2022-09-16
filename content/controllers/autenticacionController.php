<?php

namespace content\controllers;

use content\core\Aplicacion;
use content\core\Request;
use content\core\Controller;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AutenticacionController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        usuarios::validarLogout();
        $this->setLayout('auth');
        return $this->render('acceso/login/loginView');
        // return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/login/loginView.php')), 200);
    }

    public function iniciar(Request $request)
    {
        if ($request->isPost()) {
            $usuarioModel = new usuarios();
            $usuarioModel->loadData($request->getBody());
            $email = $request->getBody()['email'];
            $password = $request->getBody()['password'];
            if ($usuarioModel->validate()) {
                $consultarUsuario = $usuarioModel::login($email);
                if ($consultarUsuario && password_verify($password, $consultarUsuario['password'])) {
                    $_SESSION['email'] = 'ok';
                    $_SESSION['user'] = $consultarUsuario['id'];
                    $_SESSION['user_email'] = $consultarUsuario['email'];
                    $_SESSION['username'] = $consultarUsuario['username'];
                    $_SESSION['date'] = date('d_m_Y_H_i');
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                    /*Aplicacion::$app->session->set('email', 'ok');
                    Aplicacion::$app->session->set('user', $consultarUsuario['id']);
                    Aplicacion::$app->session->set('user_email', $consultarUsuario['email']);
                    Aplicacion::$app->session->set('username', $consultarUsuario['username']);
                    Aplicacion::$app->session->set('date', $_SERVER['REMOTE_ADDR']);
                    Aplicacion::$app->session->set('ip',  date('d_m_Y_H_i'));*/

                    $data = [
                        'title' => 'Bienvenido',
                        'messages' => 'En breve le dirigiremos al panel de control',
                        'code' => 200,
                        'route' => '/home'
                    ];
                    return json_encode($data);
                } else {
                    if (!$consultarUsuario) {
                        $usuarioModel->addError("email", "El email es incorrecto");
                        return false;
                    }
                    if (!password_verify($password, $consultarUsuario['password'])) {
                        $usuarioModel->addError("password", "La clave es incorrecta");
                        return false;
                    }
                    $data = [
                        'title' => 'Verifique sus datos',
                        'messages' => $usuarioModel->errors,
                        'code' => 422
                    ];
                    return json_encode($data);
                }
            }
            $data = [
                'title' => 'Datos invalidos',
                'messages' => $usuarioModel->errors,
                'code' => 422
            ];
            return json_encode($data, 200);
        }
        /*$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $logger = new Logger("web");
        $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
        $logger->debug(__METHOD__, [$body]);
        usuarios::validarLogout();

        if ($email == "" || $password == "") {
            $mensaje1 = "Por favor debe ingresar los datos";
        } else {
            //ejecutamos
            $consultarUsuario = usuarios::login($email);
            if ($consultarUsuario && password_verify($password, $consultarUsuario->password)) {
                $_SESSION['email'] = 'ok';
                $_SESSION['user_email'] = $consultarUsuario->email;
                $_SESSION['username'] = $consultarUsuario->username;
                $_SESSION['date'] = date('d_m_Y_H_i');
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                return $this->render('homeView', $data);
            } else {
                $mensaje2 = "Error, el correo o contraseña son incorrectos";
            }
        }*/
    }

    public function cerrarSesion()
    {
        unset($_SESSION['email']);
        unset($_SESSION['user_email']);
        unset($_SESSION['username']);
        unset($_SESSION['date']);
        unset($_SESSION['ip']);
        session_destroy();
        Aplicacion::$app->response->redirect('/');
    }

    public function cambiarContrasena()
    {
        /*usuarios::validarLogout();
        $data['titulo'] = 'Resetear Clave';
        include_once("view/acceso/login/resetPasswordView.php");*/
        usuarios::validarLogout();
        $data = [
            'name' => 'Resetea tu clave'
        ];
        $this->setLayout('auth');
        return $this->render('acceso/login/resetPasswordView', $data);
    }

    public function recuperarContrasena()
    {
        usuarios::validarLogout();
        /*$data['titulo'] = 'Clave Olvidada';
        return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/login/forgotPasswordView.php')), 200);*/
        $data = [
            'name' => 'Clave Olvidada'
        ];
        $this->setLayout('auth');
        return $this->render('acceso/login/forgotPasswordView', $data);
    }
}

?>