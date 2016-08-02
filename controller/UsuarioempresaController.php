<?php

class UsuarioempresaController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function admin() {

        //Creamos el objeto usuario
        $UsuarioEmpresa = new Usuario_Empresa($this->adapter);

        //Conseguimos todos los usuarios
        $allUsuarioEmpresa = $UsuarioEmpresa->getAll("id_usuEmpresa");


        //Cargamos la vista index y le pasamos valores

        $this->view("usuarioempresa/admin", array(
            "allusuarioempresa" => $allUsuarioEmpresa
        ));
    }

    public function create() {
        if (isset($_POST["nombre"])) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
            $Ciudad = isset($_POST["Ciudad"]) ? $_POST["Ciudad"] : "";
            $Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
            $Direccion = isset($_POST["Direccion"]) ? $_POST["Direccion"] : "";
            $Id_Usuario = isset($_POST["Id_Usuario"]) ? $_POST["Id_Usuario"] : "";
            $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
            $foto = isset($_POST["foto"]) ? $_POST["foto"] : "";
            $estado = "activo";
            $fechaReg = date("Y-m-d H:i:s");

            //Creamos un loginusuario
            $loginusuario = new Login_Usuario($this->adapter);
            $loginusuario->setContrasena($contrasena);
            $loginusuario->setEmail($Email);
            $loginusuario->setEstado($estado);
            $loginusuario->setFecha_registro($fechaReg);
            $loginusuario->setTipo_usuario("usuarioempresa");
            $newLoginUsuario = $loginusuario->save();
            
            // Creamos un usuario empresa
            $UsuarioEmpresa = new Usuario_Empresa($this->adapter);
            $UsuarioEmpresa->setNombre($nombre);
            $UsuarioEmpresa->setCiudad($Ciudad);
            $UsuarioEmpresa->setEmail($Email);
            $UsuarioEmpresa->setDireccion($Direccion);
            $UsuarioEmpresa->setId_Usuario($newLoginUsuario);
            $UsuarioEmpresa->setContrasena($contrasena);
            $UsuarioEmpresa->setFoto($foto);
            $save = $UsuarioEmpresa->save();
            $this->redirect("usuarioempresa", "admin");
        }else{
            $this->view("usuarioempresa/create", array());
        }
    }

    public function modificarUsuarioEmpresa() {


        if (isset($_POST["id_usuEmpresa"])) {


            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
            $Ciudad = isset($_POST["Ciudad"]) ? $_POST["Ciudad"] : "";
            $Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
            $Direccion = isset($_POST["Direccion"]) ? $_POST["Direccion"] : "";
            $Id_Usuario = isset($_POST["Id_Usuario"]) ? $_POST["Id_Usuario"] : "";
            $contraseña = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
            $foto = isset($_POST["foto"]) ? $_POST["foto"] : "";
            $Id_Usu_Empresa = isset($_POST["id_usuEmpresa"]) ? $_POST["id_usuEmpresa"] : "";
            //Creamos un usuario
            $UsuarioEmpresa = new Usuario_Empresa($this->adapter);
            $UsuarioEmpresa->setNombre($nombre);
            $UsuarioEmpresa->setCiudad($Ciudad);
            $UsuarioEmpresa->setEmail($Email);
            $UsuarioEmpresa->setDireccion($Direccion);
            $UsuarioEmpresa->setId_Usuario($Id_Usuario);
            $UsuarioEmpresa->setContraseña($contraseña);
            $UsuarioEmpresa->setFoto($foto);
            $UsuarioEmpresa->setId_Usu_Empresa($Id_Usu_Empresa);

            $modify = $UsuarioEmpresa->modify();
        }

        $this->view("usuarioempresa/modificar", array());
    }

    public function Consultar() {
        //if (isset($_GET["id_categoria"])) {
        //$id_categoria = (int) $_GET["id_categoria"];
        $Id_Usu_Empresa = 1;

        $UsuarioEmpresa = new Usuario_Empresa($this->adapter);

        $getById = $UsuarioEmpresa->getById("id_usuEmpresa", $Id_Usu_Empresa);

        $this->view("usuarioempresa/view", array("getById" => $getById));
    }

    //}        
}

?>