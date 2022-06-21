<?php
namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;

class carritoModel extends BD {

    public $id_articulos;
    public $id_sesion;

    public $nombre_articulo;
    public $codigo_articulo;
    public $descripcion;
    public $precio_venta;
    public $imagen;
    public $categoria;
    public $cantidad;
    public $estado;
    public $descuento;

   
    public function  __construct($id_articulos,$nombre_articulo,$descripcion,$precio_venta,$imagen,$categoria){
        $this->id_articulos=$id_articulos;
        $this->nombre_articulo=$nombre_articulo;
        $this->descripcion=$descripcion;
        $this->precio_venta=$precio_venta;
        $this->imagen=$imagen;
        $this->categoria=$categoria;
        $this->id_sesion=$id_sesion;
    }

    // Agregar articulos al carrito
    public static function agregar_al_carrito($id_articulos){
        $conexionBD=BD::crearInstancia();
        $id_sesion = $_SESSION['correoCliente'];
        $sql= $conexionBD->prepare("INSERT INTO carrito (id_sesion, id_articulos) 
        VALUES (?,?)"); 
        return $sql->execute([$id_sesion, $id_articulos]);
    }

    // Obtener el id_articulos del carrito (columnas)
    public static function obtener_id_articulos_carrito(){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT id_articulos FROM carrito where id_sesion=?");
        $id_sesion = $_SESSION['correoCliente'];
        $sql->execute(array($id_sesion));
        return $sql->fetchAll(PDO::FETCH_COLUMN);
    }

    // El mismo método de arriba pero de otra manera 
    public static function obtener_id_articulos_carrito2(){
        $conexionBD=BD::crearInstancia();
        $id_sesion = $_SESSION['correoCliente'];
        $sql=$conexionBD->query("SELECT COUNT(*) as numrows FROM carrito WHERE id_sesion='$id_sesion'");
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row["numrows"] > 0){
            $result = $row["numrows"];
            // echo json_encode($result);
        }
        return $result;
    }

    // Articulos que ya están en el carrito 
    public static function articulo_ya_esta_en_carrito($id_articulos)
    {
        $ids = carritoModel::obtener_id_articulos_carrito();
        foreach ($ids as $id) {
            if ($id == $id_articulos) return true;
        }
        return false;
    }

    // Ver detalles del carrito de compras
    public static function obtener_detalles_articulos_carrito(){
        $id_sesion = $_SESSION['correoCliente'];
        $listaCarrito=[]; 
        $conexionBD=BD::crearInstancia();
        $sql=$conexionBD->query("SELECT articulos.id_articulos, articulos.nombre_articulo, articulos.descripcion, articulos.precio_venta, articulos.imagen, categoria.categoria FROM articulos INNER JOIN carrito ON carrito.id_articulos=articulos.id_articulos INNER JOIN categoria ON categoria.id_categoria=articulos.id_categoria WHERE carrito.id_sesion='$id_sesion' ");
        foreach($sql->fetchAll() as $carro){
            $listaCarrito[]=new carritoModel($carro['id_articulos'],$carro['nombre_articulo'],$carro['descripcion'],$carro['precio_venta'],$carro['imagen'],$carro['categoria']);
        }
        return $listaCarrito;
    }

    //quitar elementos del carrito
    public static function quitar_articulos_carrito($id_articulos){
        $conexionBD=BD::crearInstancia();
        $id_sesion = $_SESSION['correoCliente'];
        $sql= $conexionBD->prepare("DELETE FROM carrito WHERE id_sesion = ? AND id_articulos = ?");
        return $sql->execute(array($id_sesion, $id_articulos));
    }

}

?>