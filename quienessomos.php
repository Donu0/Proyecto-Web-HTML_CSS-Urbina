<?php include 'includes/verificarSesion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quienes somos?</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header> 
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
                <p>Quienes somos?</p>
                <img src="https://universidadesgratuitas.com/storage/2023/09/tecnologico-de-la-laguna.jpg" alt="1">
                <p> En Sortec somos una plataforma diseñada para simplificar la gestión y participación en sorteos. 
                    Nuestro objetivo es ofrecer una experiencia ágil y fácil de usar, permitiendo a los organizadores administrar 
                    sus sorteos de manera eficiente y a los compradores adquirir sus números sin complicaciones. Trabajamos para que 
                    cada función sea clara, rápida y accesible, enfocándonos siempre en hacer que todo el proceso sea lo más 
                    práctico posible para todos.
                </p>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>