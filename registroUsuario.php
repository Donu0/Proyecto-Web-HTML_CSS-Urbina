<?php include 'includes/verificarSesion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
     <header class>
        <h1 class="titulo">Sortec</h1>
        <span class="subtitulo"> Sorteamos cosas </span> 
    </header>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="./index.php">Inicio</a>
            <a href="./quienesSomos.php">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
                if ($sesion_activa) {
                    $nombreUsuario = $_SESSION['nombre'];
                    
                    if ($_SESSION['rol'] === 'admin') {
                        echo '<a href="./adminInterface.php">Admin Panel</a>';
                    }

                    echo '
                        <div class="user-menu">
                            <button class="user-btn">Hola, ' . htmlspecialchars($nombreUsuario) . ' ▼</button>
                            <div class="user-dropdown">
                                <a href="./logout.php">Cerrar sesión</a>
                            </div>
                        </div>
                    ';
                } else {
                    echo '<a href="./acceder.php">Acceder</a>';
                }
            ?>
        </nav>
    </div> 

    <div class="contenedor">
        <div class="contenido-hero">
            <?php
                if ($sesion_activa && $_SESSION['rol'] === 'admin') {
                // Si el usuario es admin
                    echo '<h2>Añadir Usuarios</h2>';
                    echo '<p>Llena los campos pertinentes para añadir un nuevo usuario</p>';
                } else {
                    echo '<h2>Registro</h2>';
                    echo '<p>Registrate llenando los campos con tus datos</p>';
                }
            ?>

            <form class="formulario" action="./includes/altaUsuario.php" id="form1" name="form1" method="post">
                <fieldset>
                    
                    <div class="contenedor-registro">

                        <div class="campo">
                            <label>Nombre</label>
                            <input class="input-text" type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
                            <div class="error" id="nombreError"></div>
                        </div>

                        <div class="campo">
                            <label>Apellido</label>
                            <input class="input-text" type="text" name="apellido" id="apellido" placeholder="Tu Apellido">
                            <div class="error" id="apellidoError"></div>
                        </div>

                        <div class="campo">
                            <label>Teléfono</label>
                            <input class="input-text" type="text" name="telefono" id="telefono" placeholder="Tu Teléfono">
                            <div class="error" id="telefonoError"></div>
                        </div>

                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" name="correo" id="correo" placeholder="Tu Email">
                            <div class="error" id="correoError"></div>
                        </div>

                        <div class="campo">
                            <label>Contraseña</label>
                            <input class="input-text" type="password" name="contrasena" id="contrasena" placeholder="Tu Contraseña">
                            <div class="error" id="contrasenaError"></div>
                        </div>
                        
                        <div class="campo">
                            <label>Confirmar contraseña</label>
                            <input class="input-text" type="password" name="contrasena2" id="contrasena2" placeholder="Confirma tu contraseña">
                            <div class="error" id="contrasena2Error"></div>
                        </div>

                        <?php
                            if ($sesion_activa && $_SESSION['rol'] === 'admin') {
                            // Si el usuario es admin
                                echo "<div class='campo'>
                                        <label>Rol</label>
                                        <select name='rol' class='input-text'>
                                            <option value='user' <?php echo 'selected'; ?>Usuario</option>
                                            <option value='admin' <?php echo 'selected'; ?>Administrador</option>
                                        </select>
                                    </div>";
                            } else {
                                echo '<input type="hidden" name="rol" value="usuario">';
                            }
                        ?>
                    </div> 
                    
                </fieldset>

                <div>
                    <?php        
                        if ($sesion_activa && $_SESSION['rol'] === 'admin') {
                            // Si el usuario es admin
                            echo '<input class="boton stretch" type="submit" value="Añadir Usuario">';
                        } else {
                            echo '<input class="boton stretch" type="submit" value="Registrarse">';
                        } ?>
                </div>                

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>

    <!-- Validación de los campos del formulario -->
    <script src="scripts/validacionUsuario.js"></script>
    <script src="scripts/menuDesplegable.js"></script>
</body>
</html>