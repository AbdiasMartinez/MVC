<?php
// MVC/index.php
// Controlador Frontal

$controlador_nombre = isset($_GET['c']) ? $_GET['c'] : 'Login'; 
$accion_nombre = isset($_GET['a']) ? $_GET['a'] : 'index'; 

$controlador_archivo = 'controlador/' . $controlador_nombre . '_controlador.php';

if (file_exists($controlador_archivo)) {
    require_once($controlador_archivo);
    
    $clase_controlador = $controlador_nombre . '_controlador';
    $controlador = new $clase_controlador();
    
    if (method_exists($controlador, $accion_nombre)) {
        $controlador->$accion_nombre();
    } else {
        echo "Error 404: La acción '$accion_nombre' no existe.";
    }
} else {
    echo "Error 404: El controlador '$controlador_nombre' no existe.";
}
?>