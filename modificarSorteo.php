<?php include 'includes/verificarSesion.php';
    //Por el momento solo el admin puede modificar usuarios
    if ($usuario_rol !== 'admin') {
        header("Location: index.php");
        exit;
    } 

    // Validar que venga el parámetro id
    if (!isset($_GET['Sorteo']) || empty($_GET['Sorteo'])) {
        header("Location: adminInterface.php");
        exit;
    }

    $idSorteo = $_GET['Sorteo'];

    // Consultar datos del usuario
    $stmt = $conexion->prepare("SELECT * FROM Sorteo WHERE idSorteo = ?");
    $stmt->bind_param("s", $idSorteo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Si no existe, rediriger a la interfaz de admin
        $stmt->close();
        $conn->close();
        header("Location: adminInterface.php");
        exit;
    }

    $sorteo = $result->fetch_assoc();
    $stmt->close();
?>

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
            <a href="./quienesSomos.html">Quienes somos?</a>
            <a href="./catalogo.html">Catalogo</a>
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
            <h2>Modificar Sorteos</h2>
            <p> Modifica los datos que desees reemplazar </p>

            <form class="formulario" action="includes/actualizarSorteo.php" id="form1" name="form1" method="post">
                <fieldset>
                    
                    <div class="contenedor-campos">
                        <input type="hidden" name="idSorteo" value="<?php echo htmlspecialchars($sorteo['idSorteo']); ?>">

                        <div class="campo">
                            <label>Nombre Sorteo</label>
                            <input class="input-text" type="text" name="nombreSorteo" value="<?php echo htmlspecialchars($sorteo['nombreSorteo']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Organizador Sorteo</label>
                            <input class="input-text" type="text" name="organizador" value="<?php echo htmlspecialchars($sorteo['organizador']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Numero de boletos</label>
                            <input class="input-text" type="number" name="boletosRestantes" value="<?php echo intval($sorteo['boletosRestantes']); ?>" required>
                        </div>

                        <div class="campo">
                            <label>Precio de boletos</label>
                            <input class="input-text" type="number" name="precioBoleto" value="<?php echo intval($sorteo['precioBoleto']); ?>" required>
                        </div>

                        <div class="campo campo--full">
                            <label>Fecha de termino</label>
                            <input class="input-text" type="date" name="fechaJuego" value="<?php echo htmlspecialchars($sorteo['fechaJuego']); ?>" required>
                        </div>

                        <div class="campo campo--full">
                            <label>Descripcion Sorteo</label>
                            <textarea class="input-text" name ="descripcion" value="<?php echo htmlspecialchars($sorteo['descripcion']); ?>" required></textarea>
                        </div>                        
        
                    </div>  
                    
                </fieldset>   
                
                <div>
                    <input class="boton" type="submit" value="Guardar Cambios">
                    <a href ="adminInterface.php" class="boton">Cancelar</a>
                </div> 

            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Todos los derechos reservados. (Logitos de copyright y TM)</p>
    </footer>
    
</body>
</html>