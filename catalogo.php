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
            <a href="./quienessomos.html">Quienes somos?</a>
            <a href="./catalogo.php">Catalogo</a>
            <?php
            if (isset($_SESSION['idUsuario'])) {
                // Si el usuario tiene sesión activa
                echo '
                <form action="logout.php" method="POST" style="display:inline;">
                    <button type="submit" class="boton" 
                        style="background:none;border:none;color:green;cursor:pointer;">
                        ' . htmlspecialchars($_SESSION['nombre']) . ' (Cerrar sesión)
                    </button>
                </form>';
            } else {
                // Si no ha iniciado sesión
                echo '<a href="acceder.php">Acceder</a>';
            }
            ?>
        </nav>
    </div> 

    <div class="contenedor">
        <div class="contenido-hero">
            <div class="contenedor-items">
                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Carro Tec</p>
                    <img class="img-cont" src="https://picsum.photos/id/1015/800/300" alt="1">
                    <button class="boton">Ver mas</button>
                </div>

                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Te(c)rmo</p>
                    <button class="boton">Ver mas</button>
                </div>

                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Beca Tec</p>
                    <button class="boton">Ver mas</button>
                </div>

                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Atletismo</p>
                    <button class="boton">Ver mas</button>
                </div>

                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Quimica 2A</p>
                    <button class="boton">Ver mas</button>
                </div>

                <div class="item-sorteo">
                    <p class="descriptor">Sorteo Carne</p>
                    <button class="boton">Ver mas</button>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>