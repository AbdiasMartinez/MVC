<?php
// controlador/Login_controlador.php
session_start();
require_once("modelo/Login_modelo.php"); // RUTA CORREGIDA

class Login_controlador {

    public function index() {
        if (isset($_SESSION['user_id'])) {
            $this->redirigir_dashboard();
            exit();
        }
        require_once("vista/login.php");
    }

    private function redirigir_dashboard() {
        if ($_SESSION['user_tipo'] === 'admin') {
            header("Location: index.php?c=Usuario&a=listar");
        } else {
            header("Location: index.php?c=Producto&a=listar");
        }
    }

    public function validar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?c=Login");
            exit();
        }

        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $modelo = new Login_modelo();
        $usuario = $modelo->login($user_name, $password);

        if ($usuario) {
            $_SESSION['user_id'] = ($usuario['tipo'] === 'admin') ? $usuario['id_admin'] : $usuario['id_usuario'];
            $_SESSION['user_name'] = ($usuario['tipo'] === 'admin') ? $usuario['nic_name'] : $usuario['nombre'];
            $_SESSION['user_tipo'] = $usuario['tipo'];
            $_SESSION['modulos'] = explode(',', $usuario['modulos']);

            $this->redirigir_dashboard();
        } else {
            $error = "Credenciales incorrectas.";
            require_once("vista/login.php");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=Login");
        exit();
    }
}
?>