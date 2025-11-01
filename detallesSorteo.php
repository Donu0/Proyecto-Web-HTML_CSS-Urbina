<?php include 'includes/verificarSesion.php';
   require 'includes/conexion.php';

    // Validar que venga el parámetro id
    if (!isset($_GET['Sorteo']) || empty($_GET['Sorteo'])) {
        header("Location: catalogo.php");
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
        header("Location: catalogo.php");
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
                <input type="hidden" name="idSorteo" value="<?php echo htmlspecialchars($sorteo['idSorteo']); ?>">
                <h2><?php echo htmlspecialchars($sorteo['nombreSorteo']); ?></h2>
                <h3><?php echo htmlspecialchars($sorteo['fechaJuego']); ?></h3>
                <p><?php echo htmlspecialchars($sorteo['descripcion']); ?></p>
                <img src="https://picsum.photos/501/300" alt="Imagen random"> <!--- Cambiar enlace imagen, aunque enves de htmlspecialchars usar urlencode -->
                <br>
                <h3>🎟️ Selecciona tus boletos</h3>
                <p> Precio del boleto: $<?php echo intval($sorteo['precioBoleto']); ?>.00</p>
                <form action="comprar.php" method="POST">
                    <div class="boletos">
                        <?php
                        $disponibles = intval($sorteo['boletosRestantes']);
                        $comprados = [3, 7, 15, 28, 37];

                        for ($i = 1; $i <= $disponibles; $i++) {
                            if (!in_array($i, $comprados)) {
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