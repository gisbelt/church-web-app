<?php
namespace content\Core;

use config\settings\sysConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class frontController extends sysconfig{

    public $request = "url";
    private $url; 


    public function  __construct($request){
        if(isset($request["url"])){
            $this->url = $request["url"];
            if(isset($request["action"])){
                $this->action = $request["action"];
            }
            $this->validarURL();
        } else {
            die("<script>location='?url=login'</script>");
        }
    }

    private function validarURL(){
        $url = preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$ ]{1,700}$/", $this->url);
        if($url == 1){
            $this->Cargar_Pagina($this->url); /* llamdo de la funcion que cargara las vistas */
        }else{
            die('LA URL INGRESADA ES INVÁLIDA');
        }
    }

    private function Cargar_Pagina($url){
        /* verificacion si el archivo existe , en la direccion predeterminada */
        $direccionControlador = _DIRECTORY_.$url._CONTROLLER_;
        $nombreControlador = '\\content\\controllers\\'.$url.'controller';
        if(file_exists($direccionControlador)){
            /* si existe trae el archivo solicitado mediante el require_once */
            require_once $direccionControlador;
            $control = new $nombreControlador;
            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__."../../Logger/log.txt", Logger::DEBUG));
            $action = isset($this->action) ? $this->action : 'index';
            if(method_exists($control, $action)){
                return $control->$action();
            } else {
                /* si no existe redireccionaremos a la pagina de error */
                die("<script>location='?url=error'</script>");
            }

        }else{
            /* si no existe redireccionaremos a la pagina de error */
            die("<script>location='?url=error'</script>");
        }	
    }
}
?>