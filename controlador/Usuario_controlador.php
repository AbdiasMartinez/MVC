<?php
// controlador/Usuario_controlador.php
session_start();
require_once("modelo/Usuario_modelo.php"); // RUTA CORREGIDA

class Usuario_controlador {

    private function verificar_admin() {
        if (!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] !== 'admin') {
            header("Location: index.php?c=Login");
            exit();
        }
    }

    public function crear() {
        $this->verificar_admin();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'cod' => $_POST['cod'],
                'password' => $_POST['password'],
                'cedula' => $_POST['cedula'], // Recibe el campo Cédula
                'id_ai' => $_POST['id_ai'],
                'id_creador' => $_SESSION['user_id'] 
            ];
            
            $modelo = new Usuario_modelo();
            if ($modelo->crear_usuario($data)) {
                $mensaje = "Usuario creado exitosamente.";
                header("Location: index.php?c=Usuario&a=listar&msg=" . urlencode($mensaje));
                exit();
            } else {
                $error = "Error al crear el usuario. El código ya existe o faltan datos.";
            }
        }
        require_once("vista/crear_usuario.php"); // RUTA CORREGIDA
    }

    public function listar() {
        $this->verificar_admin();
        $modelo = new Usuario_modelo();
        $usuarios = $modelo->listar_usuarios($_SESSION['user_id']); 
        
        $mensaje = isset($_GET['msg']) ? urldecode($_GET['msg']) : null;
        require_once("vista/listar_usuarios.php"); // RUTA CORREGIDA
    }
    
    public function eliminar() {
        $this->verificar_admin();

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php?c=Usuario&a=listar&msg=" . urlencode("ID de usuario no proporcionado."));
            exit();
        }

        $id_usuario = $_GET['id'];
        $modelo = new Usuario_modelo();
        
        if ($modelo->eliminar_usuario($id_usuario)) {
            $mensaje = "Usuario ID $id_usuario eliminado exitosamente.";
        } else {
            // Nota: Podría fallar si el usuario tiene productos, por la clave foránea.
            $mensaje = "Error al eliminar el usuario ID $id_usuario."; 
        }
        
        header("Location: index.php?c=Usuario&a=listar&msg=" . urlencode($mensaje));
        exit();
    }
}
?>