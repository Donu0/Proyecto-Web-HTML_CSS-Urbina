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
            <a href="./index.html">Inicio</a>
            <a href="./quienessomos.html">Quienes somos?</a>
            <a href="./catalogo.html">Catalogo</a>
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
            <h2>Modificar Usuarios</h2>
            <p> Modifica los datos que desees reemplazar</p>

            <form class="formulario">
                <fieldset>
                    
                    <div class="contenedor-registro">

                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" placeholder="Tu Email">
                        </div>

                        <div class="campo">
                            <label>Contraseña</label>
                            <input class="input-text" type="password" placeholder="Tu Contraseña">
                        </div>

                        <div class="campo">
                            <label>Teléfono</label>
                            <input class="input-text" type="tel" placeholder="Num. Telefonico">
                        </div>
                    </div> 
                    
                </fieldset>

                <div>
                    <input class="boton stretch" type="submit" value="Añadir">
                </div>                

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
    
</body>
</html>