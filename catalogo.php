<?php include 'includes/verificarSesion.php'; 
    require 'includes/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
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
            <div class="contenedor-items">
                <form method="POST" action="./detallesSorteo.php" style="display:inline;">
                        <div class="tabla-responsiva">
                            <?php
                            // Consulta para obtener todos los sorteos disponibles
                                $sql = "SELECT idSorteo, nombreSorteo, fechaJuego, enlaceImagen FROM sorteo"; //Aqui iría el otro atributo enlaceImagen
                                $resultado = $conexion->query($sql);    

                                if ($resultado->num_rows > 0) {

                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "<div class='item-sorteo'>
                                                <p class='descriptor'>{$fila['nombreSorteo']}</p>
                                                <img class='img-cont' src='{$fila['enlaceImagen']}' alt='1'>
                                                <p hidden>{$fila['idSorteo']}</p>
                                                <p class='descriptor'> Juega el: {$fila['fechaJuego']}</p>
                                                <a href='detallesSorteo.php?Sorteo=" . urlencode($fila['idSorteo']) . "' class='boton stretch' title='detalles'>Ver más</a>
                                                </div>
                                                <br>";
                                    }
                                } else {
                                    echo "<p style='text-align:center;'>No hay sorteos disponibles.</p>";
                                }

                                $conexion->close();
                            ?>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>