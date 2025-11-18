<?php
// modelo/Usuario_modelo.php
require_once("Conectar.php");

class Usuario_modelo {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function crear_usuario($data) {
        // Se incluye el campo 'cedula' en el INSERT
        $sql = "INSERT INTO usuarios (nombre, cod, password, cedula, id_ai, modulos, id_creador) 
                VALUES (:nombre, :cod, :password, :cedula, :id_ai, :modulos, :id_creador)";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':nombre', $data['nombre']);
        $consulta->bindParam(':cod', $data['cod']);
        $consulta->bindParam(':password', $data['password']); // Clave plana
        $consulta->bindParam(':cedula', $data['cedula']);     // Campo Cédula
        $consulta->bindParam(':id_ai', $data['id_ai']);
        $consulta->bindValue(':modulos', 'Login,Crear producto,Listar producto'); 
        $consulta->bindParam(':id_creador', $data['id_creador']); 

        return $consulta->execute();
    }

    public function listar_usuarios($id_admin_sesion) {
        // Filtrado por creador
        $sql = "SELECT id_usuario, nombre, cod, cedula, id_ai FROM usuarios WHERE id_creador = :id_creador";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':id_creador', $id_admin_sesion);
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function eliminar_usuario($id_usuario) {
        // IMPORTANTE: Si el usuario tiene productos asociados, debes eliminarlos primero o la DB fallará.
        // Asumiendo que se maneja la eliminación:
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bindParam(':id', $id_usuario);

        return $consulta->execute();
    }
}
?>