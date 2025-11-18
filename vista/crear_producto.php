<?php 
// vista/crear_producto.php
echo '<link rel="stylesheet" href="public/css/estilos.css">';
?>

<body>
    <header class="main-header">
        <div class="logo">WebNova | Usuario: <?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
        <nav>
            <a href="index.php?c=Producto&a=listar" class="nav-link">Listar Productos</a>
            <a href="index.php?c=Login&a=logout" class="nav-link">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="form-contenedor">
        <h2>Crear Nuevo Producto</h2>

        <?php if (isset($error)): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="index.php?c=Producto&a=crear" method="POST">
            <div class="input-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="input-group">
                <label for="serial">Serial (Único)</label>
                <input type="text" id="serial" name="serial" required>
            </div>
            <div class="input-group">
                <label for="id_ai">ID AI</label>
                <input type="text" id="id_ai" name="id_ai" required>
            </div>
            
            <button type="submit" class="btn-rojo">Crear Producto</button>
        </form>
    </div>
</body>