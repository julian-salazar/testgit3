<?php

class CategoriaController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
    
    public function admin() {

        //Creamos el objeto usuario
        $categoria = new Categoria($this->adapter);

        //Conseguimos todos los usuarios
        $allcategoria = $categoria->getAll();

        /*Producto
        $producto = new Producto($this->adapter);
        $allproducts = $producto->getAll();
        */

        //Cargamos la vista index y le pasamos valores
        
        $this->view("categoria/admin", array(
            "allcategoria" => $allcategoria
        ));
    }

   
    
    public function create() {
        if (isset($_POST["nombre"])) {

            //Creamos un usuario
            $categoria = new Categoria($this->adapter);
            $categoria->setNombre($_POST["nombre"]);
            $categoria->setDescripcion($_POST["descripcion"]);
            $save = $categoria->save();
        }
        $this->view("categoria/create", array());
    }

     public function modificarCategoria() {
        if (!isset($_POST["nombre"])) {
            //Creamos un usuario
            $categoria = new Categoria($this->adapter);
            $categoria->setNombre("Melisa");
            $categoria->setDescripcion("Ponga");
            $categoria->setId_categoria(2);

            //echo "nombre>  ". $categoria->getNombre();

            $modify = $categoria->modify();
        }
        //$this->view("categoria/modificar", array());
    }

/*    public function borrar() {
        if (isset($_GET["id"])) {
            $id = (int) $_GET["id"];

            $usuario = new Categoria($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect();
    }*/
    }

?>