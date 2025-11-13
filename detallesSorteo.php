<?php 
    include 'includes/verificarSesion.php';
    require 'includes/conexion.php';

    // Para el pago con paypal o alguna otra forma de pago
    $baseUrl = 'http://localhost/Proyecto-Web-HTML_CSS-Urbina/';

    // Validar que venga el parámetro.
    if (!isset($_GET['Sorteo']) || empty($_GET['Sorteo'])) {
        header("Location: catalogo.php");
        exit;
    }

    $idSorteo = $_GET['Sorteo'];

    // Consultar datos del sorteo
    $stmt = $conexion->prepare("SELECT * FROM sorteo WHERE idSorteo = ?");
    $stmt->bind_param("s", $idSorteo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
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
    <!-- Si esto da error, lo cambiamos. -->
    <title><?php echo htmlspecialchars($sorteo['nombreSorteo']); ?></title>
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
                <h2><?php echo htmlspecialchars($sorteo['nombreSorteo']); ?></h2>
                <h3><?php echo htmlspecialchars($sorteo['fechaJuego']); ?></h3>
                <p><?php echo htmlspecialchars($sorteo['descripcion']); ?></p>
                <img src="<?php echo $sorteo['enlaceImagen']?>" alt="Imagen random"> 
                <br>
                <h3>🎟️ Selecciona tus boletos</h3>
                <p> Precio del boleto: $<?php echo intval($sorteo['precioBoleto']); ?>.00</p>
                <form action="includes/procesarCompra.php" method="POST">
                    <input type="hidden" name="idSorteo" value="<?php echo htmlspecialchars($sorteo['idSorteo']); ?>">
                    <div class="boletos">
                        <?php
                        $disponibles = intval($sorteo['boletosRestantes']);
                        //Arreglo dinámico para guardar los números de los boletos comprados
                        $comprados = [];

                        $stmtBoletos = $conexion->prepare("SELECT numero FROM Boleto WHERE idSorteo = ?");
                        $stmtBoletos->bind_param("i", $idSorteo);
                        $stmtBoletos->execute();
                        $resultBoletos = $stmtBoletos->get_result();

                        while ($filaBoleto = $resultBoletos->fetch_assoc()) {
                        $comprados[] = intval($filaBoleto['numero']);
                        }

                        $stmtBoletos->close();

                        //Los boletos comprados no se muestran

                        for ($i = 1; $i <= $disponibles; $i++) {
                            if (!in_array($i, $comprados)) {
                                echo "
                                    <input type='checkbox' id='num$i' name='numeros[]' value='$i'>
                                    <label for='num$i'>$i</label>
                                ";
                            }
                        }
                        
                        // Los boletos comprados se muestran como no disponibles

                        //$totalBoletos = $disponibles + count($comprados); // Para que se muestren todos los boletos

                        // for ($i = 1; $i <= $totalBoletos; $i++) {
                        //     if (in_array($i, $comprados)) {
                        //         // Boleto ya comprado su checkbox es rojo y deshabilitado, en teoría, nomás los muestra deshabilitados
                        //         echo "
                        //             <input type='checkbox' id='num$i' disabled class='boleto-comprado'>
                        //             <label for='num$i' class='boleto-label'>$i</label>
                        //         ";
                        //     } else {
                        //         // Boleto disponible tiene checkbox normal
                        //         echo "
                        //             <input type='checkbox' id='num$i' name='numeros[]' value='$i'>
                        //             <label for='num$i' class='boleto-label'>$i</label>
                        //         ";
                        //     }
                        // }
                        ?>
                    </div>
                    <div>
                        <button type="submit" class="boton">Comprar seleccionados</button>
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