<?php
// controlador/Producto_controlador.php
session_start();
require_once("modelo/Producto_modelo.php"); // RUTA CORREGIDA

class Producto_controlador {

    private function verificar_usuario() {
        if (!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] !== 'usuario') {
            header("Location: index.php?c=Login");
            exit();
        }
    }

    public function crear() {
        $this->verificar_usuario();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'serial' => $_POST['serial'],
                'id_ai' => $_POST['id_ai'],
                'id_creador' => $_SESSION['user_id'] 
            ];
            
            $modelo = new Producto_modelo();
            if ($modelo->crear_producto($data)) {
                $mensaje = "Producto creado exitosamente.";
                header("Location: index.php?c=Producto&a=listar&msg=" . urlencode($mensaje));
                exit();
            } else {
                $error = "Error al crear el producto. El serial ya existe o faltan datos.";
            }
        }
        require_once("vista/crear_producto.php"); // RUTA CORREGIDA
    }

    public function listar() {
        $this->verificar_usuario();
        $modelo = new Producto_modelo();
        $productos = $modelo->listar_productos($_SESSION['user_id']); 
        
        $mensaje = isset($_GET['msg']) ? urldecode($_GET['msg']) : null;
        require_once("vista/listar_productos.php"); // RUTA CORREGIDA
    }
    
    public function eliminar() {
        $this->verificar_usuario();

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php?c=Producto&a=listar&msg=" . urlencode("ID de producto no proporcionado."));
            exit();
        }

        $id_producto = $_GET['id'];
        $modelo = new Producto_modelo();
        
        if ($modelo->eliminar_producto($id_producto, $_SESSION['user_id'])) {
            $mensaje = "Producto ID $id_producto eliminado exitosamente.";
        } else {
            $mensaje = "Error al eliminar el producto ID $id_producto. (No se encontró o no te pertenece).";
        }
        
        header("Location: index.php?c=Producto&a=listar&msg=" . urlencode($mensaje));
        exit();
    }
}
?>