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
            <h2>Añadir Sorteos</h2>
            <p> Llena los campos con los datos pertinentes </p>

            <form class="formulario" action="includes/altaSorteo.php" id="form1" name="form1" method="post">
                <fieldset>
                    
                    <div class="contenedor-campos">

                        <div class="campo">
                            <label>Nombre Sorteo</label>
                            <input class="input-text" type="text" name="nombreSorteo" placeholder="Nombre">
                        </div>

                        <div class="campo">
                            <label>Organizador Sorteo</label>
                            <input class="input-text" type="text" name="organizador" placeholder="Organizador">
                        </div>

                        <div class="campo">
                            <label>Numero de boletos</label>
                            <input class="input-text" type="number" name="boletosRestantes" placeholder="Ej: 100">
                        </div>

                        <div class="campo">
                            <label>Precio de boletos</label>
                            <input class="input-text" type="number" name="precioBoleto" placeholder="Ej: 50">
                        </div>

                        <div class="campo campo--full">
                            <label>Fecha de termino</label>
                            <input class="input-text" type="date" name="fechaJuego" placeholder="12/12/2012">
                        </div>

                        <div class="campo campo--full">
                            <label>Descripcion Sorteo</label>
                            <input class="input-text" type="text" name ="descripcion">
                        </div>                        
        
                    </div> 

                    <div>
                        <input class="boton stretch" type="submit" value="Añadir">
                     </div>  
                    
                </fieldset>          
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
    
</body>
</html>