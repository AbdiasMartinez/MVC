<?php 
// vista/listar_productos.php
echo '<link rel="stylesheet" href="public/css/estilos.css">';
?>

<body>
    <header class="main-header">
        <div class="logo">WebNova | Usuario</div>
        <nav>
            <a href="index.php?c=Producto&a=crear" class="nav-link">Crear Producto</a>
            <a href="index.php?c=Login&a=logout" class="nav-link">Cerrar Sesión (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
        </nav>
    </header>

    <div class="contenedor">
        <h1>Productos Creados por ti</h1>

        <?php if (isset($mensaje)): ?>
            <p class="mensaje-exito"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Serial</th>
                    <th>ID AI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($productos)): ?>
                    <tr><td colspan="5">No has creado ningún producto aún.</td></tr>
                <?php else: ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['serial']); ?></td>
                            <td><?php echo htmlspecialchars($producto['id_ai']); ?></td>
                            <td>
                                <a href="index.php?c=Producto&a=eliminar&id=<?php echo $producto['id_producto']; ?>" 
                                   onclick="return confirm('¿Estás seguro de eliminar el producto <?php echo htmlspecialchars($producto['nombre']); ?>?');"
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