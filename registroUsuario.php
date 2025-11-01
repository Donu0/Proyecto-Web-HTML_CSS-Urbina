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
            <a href="./quienessomos.php">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
            if ($sesion_activa) {
                // Si el usuario es admin
                if ($_SESSION['rol'] === 'admin') {
                    echo '<a href="./admininterface.php">Admin Panel</a>';
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
            <?php
                if ($sesion_activa && $_SESSION['rol'] === 'admin') {
                // Si el usuario es admin
                    echo '<h2>Añadir Usuarios</h2>';
                    echo '<p>>Llena los campos pertinentes para añadir un nuevo usuario</p>';
                } else {
                    echo '<h2>Resgistro</h2>';
                    echo '<p>Registrate llenando los campos con tus datos</p>';
                }
            ?>

            <form class="formulario" action="./includes/altaUsuario.php" id="form1" name="form1" method="post">
                <fieldset>
                    
                    <div class="contenedor-registro">

                        <div class="campo">
                            <label>Nombre</label>
                            <input class="input-text" type="text" name="nombre" placeholder="Tu Nombre">
                        </div>

                        <div class="campo">
                            <label>Apellido</label>
                            <input class="input-text" type="text" name="apellido" placeholder="Tu Apellido">
                        </div>

                        <div class="campo">
                            <label>Teléfono</label>
                            <input class="input-text" type="text" name="telefono" placeholder="Tu Teléfono">
                        </div>

                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" name="correo" placeholder="Tu Email">
                        </div>

                        <div class="campo">
                            <label>Contraseña</label>
                            <input class="input-text" type="password" name="contrasena" placeholder="Tu Contraseña">
                        </div>
                        
                        <?php
                            if ($sesion_activa && $_SESSION['rol'] === 'admin') {
                            // Si el usuario es admin
                                echo '<div class="campo">
                                        <label>Rol</label>
                                        <input class="input-text" type="text" name="rol" placeholder="admin/usuario">
                                    </div>';
                            } else {
                                echo '<input type="hidden" name="rol" value="usuario">';
                            }
                        ?>
                    </div> 
                    
                </fieldset>

                <div>
                    <input class="boton stretch" type="submit" value="Registrarse">
                </div>                

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
    
</body>
</html>