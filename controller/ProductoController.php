<?php

class ProductoController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
    
    public function admin() {

        //Creamos el objeto usuario
        $producto = new Producto($this->adapter);

        //Conseguimos todos los usuarios
        $allproducto = $producto->getAll();

        /*Producto
        $producto = new Producto($this->adapter);
        $allproducts = $producto->getAll();
        */

        //Cargamos la vista index y le pasamos valores
        
        $this->view("categoria/admin", array(
            "allcategoria" => $allproducto
        ));
    }

   
    
    public function create() {
        if (isset($_POST["nombre"])) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
            $marca = isset($_POST["marca"]) ? $_POST["marca"] : "";
            $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";
            //Creamos un usuario
            $producto = new Producto($this->adapter);
            $producto->setNombre($_POST["nombre"]);
            $producto->setPrecio($precio);
            $producto->setMarca($marca);
            $producto->setCategoria($categoria);
            $save = $producto->save();
        }else{
            $categorias = new Categoria($this->adapter);
            $allCategorias = $categorias->getAll("id_Categoria");
            $this->view("productos/create", array("allCategorias" => $allCategorias));
        }
    }

     public function modificarProducto() {
        if (!isset($_POST["nombre"])) {
            //Creamos un usuario
            $producto = new Producto($this->adapter);
            $producto->setNombre("Melisa");
            $producto->setDescripcion("Ponga");
            $producto->setId_categoria(2);

            //echo "nombre>  ". $producto->getNombre();

            $modify = $producto->modify();
        }
        //$this->view("categoria/modificar", array());
    }

/*    public function borrar() {
        if (isset($_GET["id"])) {
            $id = (int) $_GET["id"];

            $usuario = new Producto($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect();
    }*/
    }

?>