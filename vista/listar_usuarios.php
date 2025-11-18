<?php 
// vista/listar_usuarios.php
echo '<link rel="stylesheet" href="public/css/estilos.css">';
?>

<body>
    <header class="main-header">
        <div class="logo">WebNova | Administrador</div>
        <nav>
            <a href="index.php?c=Usuario&a=crear" class="nav-link">Crear Usuario</a>
            <a href="index.php?c=Login&a=logout" class="nav-link">Cerrar Sesión (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
        </nav>
    </header>

    <div class="contenedor">
        <h1>Usuarios Creados por ti</h1>

        <?php if (isset($mensaje)): ?>
            <p class="mensaje-exito"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Código (Login)</th>
                    <th>ID AI</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr><td colspan="6">No has creado ningún usuario aún.</td></tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['cedula']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['cod']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['id_ai']); ?></td>
                            <td>
                                <a href="index.php?c=Usuario&a=eliminar&id=<?php echo $usuario['id_usuario']; ?>" 
                                   onclick="return confirm('¿Estás seguro de eliminar a <?php echo htmlspecialchars($usuario['nombre']); ?>? Advertencia: Esto fallará si el usuario tiene productos asociados.');"
                                   class="btn-eliminar">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>