<?php
// modelo/Producto_modelo.php
require_once("Conectar.php");

class Producto_modelo {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function crear_producto($data) {
        $sql = "INSERT INTO productos (nombre, serial, id_ai, id_creador) 
                VALUES (:nombre, :serial, :id_ai, :id_creador)";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':nombre', $data['nombre']);
        $consulta->bindParam(':serial', $data['serial']);
        $consulta->bindParam(':id_ai', $data['id_ai']);
        $consulta->bindParam(':id_creador', $data['id_creador']); 

        return $consulta->execute();
    }

    public function listar_productos($id_usuario_sesion) {
        // Filtrado por creador
        $sql = "SELECT id_producto, nombre, serial, id_ai FROM productos WHERE id_creador = :id_creador";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':id_creador', $id_usuario_sesion);
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function eliminar_producto($id_producto, $id_usuario_sesion) {
        // Filtra por ID del producto Y ID del creador (seguridad)
        $sql = "DELETE FROM productos WHERE id_producto = :id AND id_creador = :id_creador";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':id', $id_producto);
        $consulta->bindParam(':id_creador', $id_usuario_sesion);

        return $consulta->execute();
    }
}
?>