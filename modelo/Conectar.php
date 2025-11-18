<?php
// modelo/Conectar.php

class Conectar {

    public static function conexion() {
        try {
            // **AJUSTAR** la base de datos, usuario y clave si es necesario
            $conexion = new PDO('mysql:host=localhost; dbname=mvc', 'root', ''); 
            
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");

        } catch (Exception $e) {
            die("Error de Conexión: " . $e->getMessage()); 
        }
        return $conexion;
    }
}
?>