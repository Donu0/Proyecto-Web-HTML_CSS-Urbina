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
            <div class="contenedor-detalles">
                <h2>Sorteo Termo</h2>
                <h3>Fecha de termino: 27/10/25</h3>
                <p>En este sorteo se dará un termo, procurando recaudar dinero para ayudar al equipo de atletismo y asi financiar nuestro viaje a Queretaro
                    para participar en el nacional de Tecs. </p>
                <img src="https://picsum.photos/501/300" alt="Imagen random">
                <br>
                <h3>🎟️ Selecciona tus boletos</h3>
                <p> Precio del boleto: $50</p>
                <form action="comprar.php" method="POST">
                    <div class="boletos">
                        <?php
                        $total = 50;
                        $ocupados = [3, 7, 15, 28, 37];

                        for ($i = 1; $i <= $total; $i++) {
                            if (!in_array($i, $ocupados)) {
                                echo "
                                        <input type='checkbox' id='num$i' name='numeros[]' value='$i'>
                                        <label for='num$i'>$i</label>
                                    ";
                            }
                        }
                        ?>
                    </div>
                    <button type="submit" class="boton">Comprar seleccionados</button>
                </form>

            </div>
        </div>
    </div>


    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
</body>
</html>