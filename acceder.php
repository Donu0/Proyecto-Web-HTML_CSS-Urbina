<?php include 'includes/verificarSesion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="./quienesSomos.html">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
            if ($sesion_activa) {
                // Si el usuario es admin
                if ($_SESSION['rol'] === 'admin') {
                    echo '<a href="./adminInterface.php">Admin Panel</a>';
                }
                // Si el usuario tiene sesión activa
                echo '<a href="./logout.php">Cerrar sesión</a>';
            } else {
                // Si no ha iniciado sesión
                echo '<a href="./acceder.php">Acceder</a>';
            }
            ?>
        </nav>
    </div> 

    <div class="contenedor">
        <div class="contenido-hero">
            <h2>Acceder</h2>
            <p> Si tienes cuenta inicia sesión o <a href="./registroUsuario.php" style="color:green;">registrate</a> con nosotros! </p>

            <form class="formulario" action="login.php" method="POST">
                <fieldset>
                    <legend>Ingresa a tu cuenta llenando los campos</legend>

                    <div class="contenedor-registro">

                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" name="correo" placeholder="Tu Email">
                        </div>

                        <div class="campo">
                            <label>Contraseña</label>
                            <input class="input-text" type="password" name="contrasena" placeholder="Tu Contraseña">
                        </div>

                    </div> 
                    
                </fieldset>

                <div>
                    <input class="boton stretch" type="submit" value="Iniciar sesión">
                </div>                

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>