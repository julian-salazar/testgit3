<?php

class UsuariosController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
    
    public function indexNew(){
        $usuario = new Usuario($this->adapter);
        $allUsers = $usuario->getAll();
        
        $this->view("indexNew", array(
            "allusers" => $allusers
        ));
    }

    public function admin() {
        //$this->layout = "/cms_layout";

        //Creamos el objeto usuario
        $usuario = new Usuario($this->adapter);

        //Conseguimos todos los usuarios
        $allusers = $usuario->getAll("id");
        
        //Cargamos la vista index y le pasamos valores
        $this->view("usuarios/admin", array(
            "allusers" => $allusers,
            "Hola" => "Hola Mundo"
        ));
    }

    public function crear() {
        if (isset($_POST["nombre"])) {

            //Creamos un usuario
            $usuario = new Usuario($this->adapter);
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellido($_POST["apellido"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $save = $usuario->save();
            echo "Save: ".$save;
        }
        $this->view("usuarios/create");
    }

    public function borrar() {
        if (isset($_GET["id"])) {
            $id = (int) $_GET["id"];

            $usuario = new Usuario($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect();
    }

    public function hola() {
        $usuarios = new UsuariosModel($this->adapter);
        $usu = $usuarios->getUnUsuario();
        var_dump($usu);
    }

    public function imprimirNumeros(){
        for($i=1; $i<=10;$i++){
            echo "<br>Num: ".$i;
        }
    }


}

?>