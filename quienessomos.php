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
                <img src="https://picsum.photos/id/1015/800/300" alt="1">
                <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, quibusdam dolore molestiae, voluptatum temporibus fugit repellat natus amet ea adipisci, doloremque fugiat est eveniet? Blanditiis veritatis sed vero ipsum cupiditate.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur blanditiis nemo, eveniet porro itaque odio pariatur facere optio voluptatum vero ipsam vel. Animi, architecto mollitia? Eligendi dignissimos quia veritatis commodi.
                </p>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>