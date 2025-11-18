<?php
// modelo/Login_modelo.php
require_once("Conectar.php");

class Login_modelo {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function login($user_name, $password) {
        // 1. Administradores (Contraseña en texto plano)
        $sql_admin = "SELECT * FROM administradores WHERE nic_name = :user_name AND password = :password";
        
        $consulta = $this->db->prepare($sql_admin);
        $consulta->bindParam(':user_name', $user_name);
        $consulta->bindParam(':password', $password);
        $consulta->execute();
        $user_data = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            $user_data['tipo'] = 'admin';
            return $user_data;
        }

        // 2. Usuarios (Contraseña en texto plano)
        $sql_user = "SELECT * FROM usuarios WHERE cod = :user_name AND password = :password";
        
        $consulta = $this->db->prepare($sql_user);
        $consulta->bindParam(':user_name', $user_name);
        $consulta->bindParam(':password', $password);
        $consulta->execute();
        $user_data = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            $user_data['tipo'] = 'usuario';
            return $user_data;
        }

        return false;
    }
}
?>