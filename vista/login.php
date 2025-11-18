<?php 
// vista/login.php
echo '<link rel="stylesheet" href="public/css/estilos.css">';
?>

<body>
    <div class="form-contenedor">
        <h2>INICIO DE SESIÓN</h2>

        <?php if (isset($error)): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="index.php?c=Login&a=validar" method="POST">
            <div class="input-group">
                <label for="user_name">Usuario / Código</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-rojo">Ingresar</button>
        </form>
    </div>
</body>