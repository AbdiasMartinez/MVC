<?php 
// vista/crear_usuario.php
echo '<link rel="stylesheet" href="public/css/estilos.css">';
?>

<body>
    <header class="main-header">
        <div class="logo">WebNova | Admin: <?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
        <nav>
            <a href="index.php?c=Usuario&a=listar" class="nav-link">Listar Usuarios</a>
            <a href="index.php?c=Login&a=logout" class="nav-link">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="form-contenedor">
        <h2>Crear Nuevo Usuario</h2>

        <?php if (isset($error)): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="index.php?c=Usuario&a=crear" method="POST">
            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="input-group">
                <label for="cod">Código (Login)</label>
                <input type="text" id="cod" name="cod" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="cedula">Cédula</label>
                <input type="text" id="cedula" name="cedula" required>
            </div>
            <div class="input-group">
                <label for="id_ai">ID AI</label>
                <input type="text" id="id_ai" name="id_ai" required>
            </div>
            
            <button type="submit" class="btn-rojo">Crear Usuario</button>
        </form>
    </div>
</body>